<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Database\OTF;
use App\Database\Config;
use App\SUtils\SUtil;

class MrpAddWhsUnitsTable extends Migration {
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

          Schema::connection($this->sConnection)->create('wms_units', function (blueprint $table) {
          	$table->increments('id_unit');
          	$table->char('code', 25);
          	$table->char('name', 255);
          	$table->decimal('unit_base_equivalence_opt', 23,8);
          	$table->integer('cfd_unit_id')->unsigned();
          	$table->boolean('is_deleted');
          	$table->integer('unit_base_id_opt')->unsigned()->nullable();
          	$table->integer('created_by_id')->unsigned();
          	$table->integer('updated_by_id')->unsigned();
          	$table->timestamps();

          	$table->foreign('unit_base_id_opt')->references('id_unit')->on('wms_units')->onDelete('cascade');
          	$table->foreign('created_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          	$table->foreign('updated_by_id')->references('id')->on(DB::connection(Config::getConnSys())->getDatabaseName().'.'.'users')->onDelete('cascade');
          });

          DB::connection($this->sConnection)->table('wms_units')->insert([
          	['id_unit' => '1','code' => 'n/a','name' => '(N/A)','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '2','code' => 'un','name' => 'UNIDAD','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '3','code' => 'pza','name' => 'PIEZA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '4','code' => 'dec','name' => 'DECENA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '5','code' => 'cen','name' => 'CENTENA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '6','code' => 'mil','name' => 'MILLAR','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '7','code' => 'doc','name' => 'DOCENA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '8','code' => 'gru','name' => 'GRUESA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '9','code' => 'km','name' => 'KILÓMETRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '10','code' => 'hm','name' => 'HECTÓMETRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '11','code' => 'dam','name' => 'DECÁMETRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '12','code' => 'm','name' => 'METRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '13','code' => 'dm','name' => 'DECÍMETRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '14','code' => 'cm','name' => 'CENTÍMETRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '15','code' => 'mm','name' => 'MILÍMETRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '16','code' => 'mile','name' => 'MILLA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '17','code' => 'perch','name' => 'PERCA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '18','code' => 'yd','name' => 'YARDA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '19','code' => 'ft','name' => 'PIE','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '20','code' => 'in','name' => 'PULGADA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '21','code' => 'km²','name' => 'KILÓMETRO CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '22','code' => 'hm²','name' => 'HECTÓMETRO CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '23','code' => 'dam²','name' => 'DECÁMETRO CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '24','code' => 'm²','name' => 'METRO CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '25','code' => 'dm²','name' => 'DECÍMETRO CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '26','code' => 'cm²','name' => 'CENTÍMETRO CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '27','code' => 'mm²','name' => 'MILÍMETRO CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '28','code' => 'mile²','name' => 'MILLA CUADRADA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '29','code' => 'perch²','name' => 'PERCA CUADRADA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '30','code' => 'yd²','name' => 'YARDA CUADRADA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '31','code' => 'ft²','name' => 'PIE CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '32','code' => 'in²','name' => 'PULGADA CUADRADA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '33','code' => 'ha','name' => 'HECTÁREA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '34','code' => 'a','name' => 'ÁREA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '35','code' => 'ca','name' => 'CENTIÁREA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '36','code' => 'ac','name' => 'ACRE','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '37','code' => 'km³','name' => 'KILÓMETRO CÚBICO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '38','code' => 'hm³','name' => 'HECTÓMETRO CÚBICO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '39','code' => 'dam³','name' => 'DECÁMETRO CÚBICO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '40','code' => 'm³','name' => 'METRO CÚBICO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '41','code' => 'dm³','name' => 'DECÍMETRO CÚBICO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '42','code' => 'cm³','name' => 'CENTÍMETRO CÚBICO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '43','code' => 'mm³','name' => 'MILÍMETRO CÚBICO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '44','code' => 'mile³','name' => 'MILLA CÚBICA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '45','code' => 'perch³','name' => 'PERCA CÚBICA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '46','code' => 'yd³','name' => 'YARDA CÚBICA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '47','code' => 'ft³','name' => 'PIE CÚBICO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '48','code' => 'in³','name' => 'PULGADA CÚBICA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '49','code' => 'kl','name' => 'KILOLITRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '50','code' => 'hl','name' => 'HECTOLITRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '51','code' => 'dal','name' => 'DECALITRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '52','code' => 'l','name' => 'LITRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '53','code' => 'dl','name' => 'DECILITRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '54','code' => 'cl','name' => 'CENTILITRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '55','code' => 'ml','name' => 'MILILITRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '56','code' => 'gal (US)','name' => 'GALÓN US','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '57','code' => 'gal (UK)','name' => 'GALÓN UK','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '58','code' => 'ton','name' => 'TONELADA MÉTRICA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '59','code' => 'kg','name' => 'KILOGRAMO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '60','code' => 'hg','name' => 'HECTOGRAMO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '61','code' => 'dag','name' => 'DECAGRAMO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '62','code' => 'g','name' => 'GRAMO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '63','code' => 'dg','name' => 'DECIGRAMO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '64','code' => 'cg','name' => 'CENTIGRAMO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '65','code' => 'mg','name' => 'MILIGRAMO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '66','code' => 'lb','name' => 'LIBRA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '67','code' => 'oz','name' => 'ONZA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '68','code' => 'D','name' => 'DIA 24H','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '69','code' => 'd','name' => 'DIA 8H','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '70','code' => 'h','name' => 'HORA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '71','code' => 'm','name' => 'MINUTO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '72','code' => 's','name' => 'SEGUNDO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '73','code' => 'TMA','name' => 'TARIMA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '74','code' => 'CHA','name' => 'CHAROLA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '75','code' => 'CAJ','name' => 'CAJA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '76','code' => 'CAN','name' => 'CANASTA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '77','code' => 'TAM','name' => 'TAMBO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '78','code' => 'CUB','name' => 'CUBETA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '79','code' => 'BID','name' => 'BIDÓN','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '80','code' => 'GAR','name' => 'GARRAFA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '81','code' => 'TRO','name' => 'TARRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '82','code' => 'BOT','name' => 'BOTELLA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '83','code' => 'FRA','name' => 'FRASCO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '84','code' => 'LAT','name' => 'LATA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '85','code' => 'BUL','name' => 'BULTO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '86','code' => 'SAC','name' => 'SACO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '87','code' => 'BOL','name' => 'BOLSA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '88','code' => 'PAQ','name' => 'PAQUETE','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '89','code' => 'LOT','name' => 'LOTE','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '90','code' => 'TON','name' => 'TONELADA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '91','code' => 'KG','name' => 'KILOGRAMO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '92','code' => 'GR','name' => 'GRAMO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '93','code' => 'LB','name' => 'LIBRA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '94','code' => 'OZ','name' => 'ONZA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '95','code' => 'M','name' => 'METRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '96','code' => 'CM','name' => 'CENTÍMETRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '97','code' => 'YD','name' => 'YARDA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '98','code' => 'FT','name' => 'PIE','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '99','code' => 'IN','name' => 'PULGADA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '100','code' => 'L','name' => 'LITRO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '101','code' => 'GAL','name' => 'GALÓN','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '102','code' => 'MES','name' => 'MES','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '103','code' => 'DIA','name' => 'DÍA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '104','code' => 'HR','name' => 'HORA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '105','code' => 'KW','name' => 'KILOWATT/HORA','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '106','code' => 'TAM','name' => 'TAMBOR','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '107','code' => 'JUE','name' => 'JUEGO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '108','code' => 'mdm²','name' => 'MILLAR METRO CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
          	['id_unit' => '109','code' => 'mdft²','name' => 'MILLAR PIE CUADRADO','unit_base_equivalence_opt' => '0','is_deleted' => '0','cfd_unit_id' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
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

          Schema::connection($this->sConnection)->drop('wms_units');
        }
    }
}
