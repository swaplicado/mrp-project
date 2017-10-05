<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::connection('ssystem')->create('syss_permission_types', function (blueprint $table) {
      	$table->increments('id_type');
      	$table->char('name', 100);
      	$table->boolean('is_deleted');
      });

      DB::table('syss_permission_types')->insert([
      	['id_type' => '1','name' => 'Módulo', 'is_deleted' => '0'],
      	['id_type' => '2','name' => 'Sucursal', 'is_deleted' => '0'],
      	['id_type' => '3','name' => 'Almacén', 'is_deleted' => '0'],
        ['id_type' => '4','name' => 'Vista', 'is_deleted' => '0'],
      ]);

      Schema::connection('ssystem')->create('syss_permissions', function (blueprint $table) {
      	$table->increments('id_permission');
      	$table->char('code_siie', 50);
      	$table->char('name', 100);
      	$table->boolean('is_deleted');
      	$table->integer('permission_type_id')->unsigned();
      	$table->integer('module_id')->unsigned();
      	$table->timestamps();

        $table->unique(['code_siie']);
      	$table->foreign('permission_type_id')->references('id_type')->on('syss_permission_types')->onDelete('cascade');
        $table->foreign('module_id')->references('id_module')->on('syss_modules')->onDelete('cascade');
      });

      DB::table('syss_permissions')->insert([
      	['id_permission' => '1','code_siie' => '001','name' => 'Módulo Producción', 'is_deleted' => '0','permission_type_id' => '1','module_id' => '1'],
      	['id_permission' => '2','code_siie' => '002','name' => 'Módulo Calidad', 'is_deleted' => '0','permission_type_id' => '1','module_id' => '2'],
      	['id_permission' => '3','code_siie' => '003','name' => 'Módulo Almacenes', 'is_deleted' => '0','permission_type_id' => '1','module_id' => '3'],
      	['id_permission' => '4','code_siie' => '004','name' => 'Módulo Embarques', 'is_deleted' => '0','permission_type_id' => '1','module_id' => '4'],
      	['id_permission' => '5','code_siie' => '005','name' => 'Módulo Central', 'is_deleted' => '0','permission_type_id' => '1','module_id' => '5'],
      	['id_permission' => '6','code_siie' => '007','name' => 'Siie empresas', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '5'],
      	['id_permission' => '7','code_siie' => '008','name' => 'Sucursales', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '5'],
      	['id_permission' => '8','code_siie' => '009','name' => 'Periodos', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '5'],
      	['id_permission' => '9','code_siie' => '010','name' => 'Ejercicios', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '5'],
      	['id_permission' => '10','code_siie' => '011','name' => 'Asociados de negocios', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '5'],
      	['id_permission' => '11','code_siie' => '012','name' => 'Unidades', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '3'],
      	['id_permission' => '12','code_siie' => '013','name' => 'Almacenes', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '3'],
      	['id_permission' => '13','code_siie' => '014','name' => 'Ubicaciones', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '3'],
      	['id_permission' => '14','code_siie' => '015','name' => 'Familias', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '3'],
      	['id_permission' => '15','code_siie' => '016','name' => 'Grupos', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '3'],
      	['id_permission' => '16','code_siie' => '017','name' => 'Géneros', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '3'],
      	['id_permission' => '17','code_siie' => '018','name' => 'ítems', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '3'],
      	['id_permission' => '18','code_siie' => '019','name' => 'IÍtem-unidad', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '3'],
      	['id_permission' => '19','code_siie' => '020','name' => 'Códigos de barras', 'is_deleted' => '0','permission_type_id' => '4','module_id' => '3'],
      ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('syss_permissions');
      Schema::drop('syss_permission_types');
    }
}
