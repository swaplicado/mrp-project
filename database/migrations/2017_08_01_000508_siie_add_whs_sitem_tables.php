<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Database\OTF;
use App\Database\Config;
use App\SUtils\SUtil;

class SiieAddWhsSitemTables extends Migration {
    private $lDatabases;
    private $sConnection;
    private $sDataBase;
    private $bDefault;
    private $sHost;
    private $sUser;
    private $sPassword;

    public function __construct()
    {
      $this->lDatabases = Config::getDataBases();
      $this->sConnection = 'company';
      $this->sDataBase = '';
      $this->bDefault = false;
      $this->sHost = NULL;
      $this->sUser = NULL;
      $this->sPassword = NULL;
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->lDatabases as $base) {
          $this->sDataBase = $base;
          SUtil::reconnectDataBase($this->sConnection, $this->bDefault, $this->sHost, $this->sDataBase, $this->sUser, $this->sPassword);

          Schema::connection($this->sConnection)->create('wmss_item_link_types', function (blueprint $table) {
          	$table->increments('id_type');
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          });

          DB::connection($this->sConnection)->table('wmss_item_link_types')->insert([
          	['id_type' => '1','name' => 'TODO','is_deleted' => '0'],
          	['id_type' => '2','name' => 'CLASE ÍTEM','is_deleted' => '0'],
          	['id_type' => '3','name' => 'TIPO ÍTEM','is_deleted' => '0'],
          	['id_type' => '4','name' => 'FAMILIA','is_deleted' => '0'],
          	['id_type' => '5','name' => 'GRUPO','is_deleted' => '0'],
          	['id_type' => '6','name' => 'GÉNERO','is_deleted' => '0'],
          	['id_type' => '7','name' => 'ÍTEM','is_deleted' => '0'],
          ]);

          Schema::connection($this->sConnection)->create('wmss_item_classes', function (blueprint $table) {
          	$table->increments('id_class');
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          });

          DB::connection($this->sConnection)->table('wmss_item_classes')->insert([
          	['id_class' => '1','name' => 'MATERIAL','is_deleted' => '0'],
          	['id_class' => '2','name' => 'PRODUCTO','is_deleted' => '0'],
          	['id_class' => '3','name' => 'GASTO','is_deleted' => '0'],
          ]);

          Schema::connection($this->sConnection)->create('wmss_item_types', function (blueprint $table) {
          	$table->increments('id_itm_type');
          	$table->integer('id_type');
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          	$table->integer('class_id')->unsigned();

          	$table->unique(['class_id', 'id_type']);
          	$table->foreign('class_id')->references('id_class')->on('wmss_item_classes')->onDelete('cascade');
          });

          DB::connection($this->sConnection)->table('wmss_item_types')->insert([
          	['id_itm_type' => '1','id_type' => '1','name' => 'MATERIAL DIRECTO INSUMO', 'is_deleted' => '0', 'class_id' => '1'],
          	['id_itm_type' => '2','id_type' => '2','name' => 'MATERIAL DIRECTO EMPAQUE', 'is_deleted' => '0', 'class_id' => '1'],
          	['id_itm_type' => '3','id_type' => '3','name' => 'MATERIAL INDIRECTO', 'is_deleted' => '0', 'class_id' => '1'],
          	['id_itm_type' => '4','id_type' => '4','name' => 'REPROCESO', 'is_deleted' => '0', 'class_id' => '1'],
          	['id_itm_type' => '5','id_type' => '1','name' => 'PRODUCTO', 'is_deleted' => '0', 'class_id' => '2'],
          	['id_itm_type' => '6','id_type' => '2','name' => 'PRODUCTO BASE', 'is_deleted' => '0', 'class_id' => '2'],
          	['id_itm_type' => '7','id_type' => '3','name' => 'PRODUCTO TERMINADO', 'is_deleted' => '0', 'class_id' => '2'],
          	['id_itm_type' => '8','id_type' => '4','name' => 'SUBPRODUCTO', 'is_deleted' => '0', 'class_id' => '2'],
          	['id_itm_type' => '9','id_type' => '5','name' => 'DESECHO', 'is_deleted' => '0', 'class_id' => '2'],
          	['id_itm_type' => '10','id_type' => '1','name' => 'GASTO COMPRAS', 'is_deleted' => '0', 'class_id' => '3'],
          	['id_itm_type' => '11','id_type' => '2','name' => 'GASTO DIRECTO', 'is_deleted' => '0', 'class_id' => '3'],
          	['id_itm_type' => '12','id_type' => '3','name' => 'GASTO INDIRECTO', 'is_deleted' => '0', 'class_id' => '3'],
          ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->lDatabases as $base) {
          $this->sDataBase = $base;
          SUtil::reconnectDataBase($this->sConnection, $this->bDefault, $this->sHost, $this->sDataBase, $this->sUser, $this->sPassword);

          Schema::connection($this->sConnection)->drop('wmss_item_types');
          Schema::connection($this->sConnection)->drop('wmss_item_classes');
          Schema::connection($this->sConnection)->drop('wmss_item_link_types');
        }
    }
}
