<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Database\OTF;
use App\Database\Config;
use App\SUtils\SUtil;

class MrpAddWhsItemsTable extends Migration {
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

          Schema::connection($this->sConnection)->create('wms_item_families', function (blueprint $table) {
          	$table->increments('id_family');
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          	$table->integer('created_by_id')->unsigned();
          	$table->integer('updated_by_id')->unsigned();
          	$table->timestamps();

          	$table->foreign('created_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          	$table->foreign('updated_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          });

          Schema::connection($this->sConnection)->create('wms_item_groups', function (blueprint $table) {
          	$table->increments('id_group');
          	$table->char('name', 50);
          	$table->boolean('is_deleted');
          	$table->integer('family_id')->unsigned();
          	$table->integer('created_by_id')->unsigned();
          	$table->integer('updated_by_id')->unsigned();
          	$table->timestamps();

          	$table->foreign('family_id')->references('id_family')->on('wms_item_families')->onDelete('cascade');
          	$table->foreign('created_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          	$table->foreign('updated_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          });

          Schema::connection($this->sConnection)->create('wms_item_genders', function (blueprint $table) {
          	$table->increments('id_gender');
          	$table->char('name', 50);
          	$table->boolean('is_length');
          	$table->boolean('is_length_var');
          	$table->boolean('is_surface');
          	$table->boolean('is_surface_var');
          	$table->boolean('is_volume');
          	$table->boolean('is_volume_var');
          	$table->boolean('is_mass');
          	$table->boolean('is_mass_var');
          	$table->boolean('is_lot');
          	$table->boolean('is_bulk');
          	$table->boolean('is_deleted');
          	$table->integer('group_id')->unsigned();
          	$table->integer('item_class_id')->unsigned();
          	$table->integer('item_type_id')->unsigned();
          	$table->integer('created_by_id')->unsigned();
          	$table->integer('updated_by_id')->unsigned();
          	$table->timestamps();

          	$table->foreign('group_id')->references('id_group')->on('wms_item_groups')->onDelete('cascade');
          	$table->foreign('item_class_id')->references('id_class')->on('wmss_item_classes')->onDelete('cascade');
          	$table->foreign('item_type_id')->references('id_itm_type')->on('wmss_item_types')->onDelete('cascade');
          	$table->foreign('created_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          	$table->foreign('updated_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          });

          Schema::connection($this->sConnection)->create('wms_items', function (blueprint $table) {
          	$table->increments('id_item');
          	$table->char('code', 10);
          	$table->char('name', 255);
          	$table->char('base_name', 130);
          	$table->char('presentation', 50);
          	$table->decimal('length', 23,8);
          	$table->decimal('surface', 23,8);
          	$table->decimal('volume', 23,8);
          	$table->decimal('mass', 23,8);
          	$table->decimal('pallet_qty', 23,8);
          	$table->boolean('is_lot');
          	$table->boolean('is_bulk');
          	$table->boolean('is_deleted');
          	$table->integer('gender_id')->unsigned();
          	$table->integer('unit_id')->unsigned();
          	$table->integer('created_by_id')->unsigned();
          	$table->integer('updated_by_id')->unsigned();
          	$table->timestamps();

          	$table->foreign('gender_id')->references('id_gender')->on('wms_item_genders')->onDelete('cascade');
          	$table->foreign('unit_id')->references('id_unit')->on('wms_units')->onDelete('cascade');
          	$table->foreign('created_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          	$table->foreign('updated_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          });

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

          Schema::connection($this->sConnection)->drop('wms_items');
          Schema::connection($this->sConnection)->drop('wms_item_genders');
          Schema::connection($this->sConnection)->drop('wms_item_groups');
          Schema::connection($this->sConnection)->drop('wms_item_families');
        }
    }
}
