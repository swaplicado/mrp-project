<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Database\OTF;
use App\Database\Config;
use App\SUtils\SUtil;

class MrpAddWhsMvtTables extends Migration {
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

          Schema::connection($this->sConnection)->create('wmss_mvt_whs_classes', function (blueprint $table) {
          	$table->increments('id_class');
            $table->char('code', 5)->unique();
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          });

          DB::connection($this->sConnection)->table('wmss_mvt_whs_classes')->insert([
          	['id_class' => '1','code' => 'E','name' => 'ENTRADA','is_deleted' => '0'],
          	['id_class' => '2','code' => 'S','name' => 'SALIDA','is_deleted' => '0'],
          ]);

          Schema::connection($this->sConnection)->create('wmss_mvt_whs_types', function (blueprint $table) {
          	$table->increments('id_whs_type');
          	$table->integer('id_type');
          	$table->char('code', 5)->unique();
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          	$table->integer('class_id')->unsigned();

          	$table->unique(['class_id', 'id_type']);
          	$table->foreign('class_id')->references('id_class')->on('wmss_mvt_whs_classes')->onDelete('cascade');
          });

          DB::connection($this->sConnection)->table('wmss_mvt_whs_types')->insert([
          	['id_whs_type' => '1','id_type' => '1','code' => 'EV','name' => 'ENTRADA VENTA','class_id' => '1','is_deleted' => '0'],
          	['id_whs_type' => '2','id_type' => '2','code' => 'EC','name' => 'ENTRADA COMPRA','class_id' => '1','is_deleted' => '0'],
          	['id_whs_type' => '3','id_type' => '3','code' => 'EA','name' => 'ENTRADA AJUSTE','class_id' => '1','is_deleted' => '0'],
          	['id_whs_type' => '4','id_type' => '4','code' => 'ET','name' => 'ENTRADA TRASPASO','class_id' => '1','is_deleted' => '0'],
          	['id_whs_type' => '5','id_type' => '5','code' => 'EN','name' => 'ENTRADA CONVERSIÓN','class_id' => '1','is_deleted' => '0'],
          	['id_whs_type' => '6','id_type' => '6','code' => 'EP','name' => 'ENTRADA PRODUCCIÓN','class_id' => '1','is_deleted' => '0'],
          	['id_whs_type' => '7','id_type' => '7','code' => 'EG','name' => 'ENTRADA GASTOS','class_id' => '1','is_deleted' => '0'],
          	['id_whs_type' => '8','id_type' => '1','code' => 'SV','name' => 'SALIDA VENTA','class_id' => '2','is_deleted' => '0'],
          	['id_whs_type' => '9','id_type' => '2','code' => 'SC','name' => 'SALIDA COMPRA','class_id' => '2','is_deleted' => '0'],
          	['id_whs_type' => '10','id_type' => '3','code' => 'SA','name' => 'SALIDA AJUSTE','class_id' => '2','is_deleted' => '0'],
          	['id_whs_type' => '11','id_type' => '4','code' => 'ST','name' => 'SALIDA TRASPASO','class_id' => '2','is_deleted' => '0'],
          	['id_whs_type' => '12','id_type' => '5','code' => 'SN','name' => 'SALIDA CONVERSIÓN','class_id' => '2','is_deleted' => '0'],
          	['id_whs_type' => '13','id_type' => '6','code' => 'SP','name' => 'SALIDA PRODUCCIÓN','class_id' => '2','is_deleted' => '0'],
          	['id_whs_type' => '14','id_type' => '7','code' => 'SG','name' => 'SALIDA GASTOS','class_id' => '2','is_deleted' => '0'],
          ]);

          Schema::connection($this->sConnection)->create('wmss_mvt_spt_types', function (blueprint $table) {
          	$table->increments('id_type');
          	$table->char('code', 5)->unique();
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          });

          DB::connection($this->sConnection)->table('wmss_mvt_spt_types')->insert([
          	['id_type' => '1','code' => 'SD','name' => 'SURTIDO/DEVOLUCIÓN','is_deleted' => '0'],
          	['id_type' => '2','code' => 'CAM','name' => 'CAMBIO','is_deleted' => '0'],
          	['id_type' => '3','code' => 'GAR','name' => 'GARANTÍA','is_deleted' => '0'],
          	['id_type' => '4','code' => 'CON','name' => 'CONSIGNACIÓN','is_deleted' => '0'],
          ]);

          Schema::connection($this->sConnection)->create('wmss_mvt_mfg_types', function (blueprint $table) {
          	$table->increments('id_type');
          	$table->char('code', 5)->unique();
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          });

          DB::connection($this->sConnection)->table('wmss_mvt_mfg_types')->insert([
          	['id_type' => '1','code' => 'MAT','name' => 'MATERIALES','is_deleted' => '0'],
          	['id_type' => '2','code' => 'PRO','name' => 'PRODUCTO','is_deleted' => '0'],
          ]);

          Schema::connection($this->sConnection)->create('wmss_mvt_adj_types', function (blueprint $table) {
          	$table->increments('id_type');
          	$table->char('code', 5)->unique();
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          });

          DB::connection($this->sConnection)->table('wmss_mvt_adj_types')->insert([
          	['id_type' => '1','code' => 'IIF','name' => 'INVENTARIO (INICIAL Y FINAL)','is_deleted' => '1'],
          	['id_type' => '2','code' => 'CPI','name' => 'CORRECCIÓN POR DISCREPANCIA','is_deleted' => '2'],
          	['id_type' => '3','code' => 'CPE','name' => 'CORRECCIÓN POR EQUIVOCACIÓN','is_deleted' => '3'],
          	['id_type' => '4','code' => 'DPO','name' => 'DEPOSICIÓN POR OBSOLESCENCIA','is_deleted' => '4'],
          	['id_type' => '5','code' => 'DPC','name' => 'DEPOSICIÓN POR CADUCIDAD','is_deleted' => '5'],
          	['id_type' => '6','code' => 'DPD','name' => 'DEPOSICIÓN POR DAÑO','is_deleted' => '6'],
          	['id_type' => '7','code' => 'MCO','name' => 'MUESTRA COMERCIAL','is_deleted' => '7'],
          	['id_type' => '8','code' => 'MPR','name' => 'MUESTRA PROMOCIONAL','is_deleted' => '8'],
          	['id_type' => '9','code' => 'IYD','name' => 'INVESTIGACIÓN Y DESARROLLO','is_deleted' => '9'],
          	['id_type' => '10','code' => 'LAB','name' => 'LABORATORIO','is_deleted' => '10'],
          	['id_type' => '11','code' => 'DEG','name' => 'DEGUSTACIÓN','is_deleted' => '11'],
          	['id_type' => '12','code' => 'DON','name' => 'DONACIÓN','is_deleted' => '12'],
          	['id_type' => '13','code' => 'OTR','name' => 'OTROS','is_deleted' => '13'],
          ]);

          Schema::connection($this->sConnection)->create('wmss_mvt_exp_types', function (blueprint $table) {
          	$table->increments('id_type');
          	$table->char('code', 5)->unique();
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          });

          DB::connection($this->sConnection)->table('wmss_mvt_exp_types')->insert([
          	['id_type' => '1','code' => 'NA','name' => 'N/A','is_deleted' => ''],
          	['id_type' => '2','code' => 'C','name' => 'COMPRAS','is_deleted' => ''],
          	['id_type' => '3','code' => 'P','name' => 'PRODUCCIÓN','is_deleted' => ''],
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
          Schema::connection($this->sConnection)->drop('wmss_mvt_exp_types');
          Schema::connection($this->sConnection)->drop('wmss_mvt_adj_types');
          Schema::connection($this->sConnection)->drop('wmss_mvt_mfg_types');
          Schema::connection($this->sConnection)->drop('wmss_mvt_spt_types');
          Schema::connection($this->sConnection)->drop('wmss_mvt_whs_types');
          Schema::connection($this->sConnection)->drop('wmss_mvt_whs_classes');
        }
    }
}
