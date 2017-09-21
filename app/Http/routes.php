<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/notfound', ['as' => 'notfound',
function () {
    return view('errors.404');
}]);

Route::get('/notauthorized', ['as' => 'notauthorized',
function () {
    return view('errors.401');
}]);

Route::group(['middleware' => ['auth']], function() {

//****************************************/ Start/*************************

	Route::resource('start','SSys\SStartController');
	Route::get('/start',[
		'as' => 'start',
		'uses' => 'SSys\SStartController@index'
	]);
	Route::post('/start/in',[
		'as' => 'start.getIn',
		'uses' => 'SSys\SStartController@GetIn'
	]);

//****************************************/ Admin/*************************
	Route::group(['middleware' => ['mdadmin']], function() {

		Route::get('/admin',[
			'as' => 'plantilla.admin',
			'uses' => 'SPlantillaController@index'
		]);

		Route::get('/captura',[
			'as' => 'Plantilla.captura',
			'uses' => 'SPlantillaController@captura'
		]);

		Route::get('/listado',[
			'as' => 'Plantilla.listado',
			'uses' => 'SPlantillaController@listado'
		]);

		Route::resource('users','SUsersController');
		Route::get('users/{id}/activate', [
			'uses' => 'SUsersController@Activate',
			'as' => 'users.activate'
		]);
		Route::get('users/{id}/copy', [
			'uses' => 'SUsersController@Copy',
			'as' => 'users.copy'
		]);
		Route::get('users/{id}/destroy',[
			'uses' => 'SUsersController@Destroy',
			'as' => 'users.destroy'
		]);

		Route::resource('privileges','SSys\SPrivilegesController');
		Route::get('privileges/{id}/activate', [
			'uses' => 'SSys\SPrivilegesController@Activate',
			'as' => 'privileges.activate'
		]);
		Route::get('privileges/{id}/destroy',[
			'uses' => 'SSys\SPrivilegesController@Destroy',
			'as' => 'privileges.destroy'
		]);

		Route::resource('permissions','SSys\SPermissionsController');
		Route::get('permissions/{id}/activate', [
			'uses' => 'SSys\SPermissionsController@Activate',
			'as' => 'permissions.activate'
		]);
		Route::get('permissions/{id}/destroy',[
			'uses' => 'SSys\SPermissionsController@Destroy',
			'as' => 'permissions.destroy'
		]);

		Route::resource('userPermissions','SSys\SUserPermissionsController');
		Route::get('userPermissions/{id}/activate', [
			'uses' => 'SSys\SUserPermissionsController@Activate',
			'as' => 'userPermissions.activate'
		]);
		Route::get('userPermissions/{id}/destroy',[
			'uses' => 'SSys\SUserPermissionsController@Destroy',
			'as' => 'userPermissions.destroy'
		]);

    Route::resource('companies','SSys\SCompaniesController');
    Route::get('companies/{id}/destroy',[
			'uses' => 'SSys\SCompaniesController@Destroy',
			'as' => 'companies.destroy'
		]);
    Route::get('companies/{id}/activate', [
			'uses' => 'SSys\SCompaniesController@Activate',
			'as' => 'companies.activate'
		]);

	});

//****************************************/ Company /*************************

	Route::group(['middleware' => ['mdcompany']], function() {

		Route::get('/modules',[
			'as' => 'start.selmod',
			'uses' => 'SSys\SStartController@SelectModule'
		]);

//****************************************/ Manufacturing /*************************
		Route::get('/mms/home',[
			'as' => 'mms.home',
			'uses' => 'SMMS\SProductionController@Home'
		]);
		Route::resource('mms','SMMS\SProductionController');

//****************************************/ Quality /*************************
		Route::get('/qms/home',[
			'as' => 'qms.home',
			'uses' => 'SQMS\SQualityController@Home'
		]);
		Route::resource('qms','SQMS\SQualityController');

//****************************************/ Warehouses /*************************

  Route::group(['prefix' => 'wms'], function () {
  		Route::get('/home',[
  			'as' => 'wms.home',
  			'uses' => 'SWMS\SWmsController@Home'
  		]);
  		Route::resource('wms','SWMS\SWmsController');

      Route::resource('units','SWMS\SUnitsController');
      Route::get('units/{id}/destroy',[
        'uses' => 'SWMS\SUnitsController@Destroy',
        'as' => 'wms.units.destroy'
      ]);
      Route::get('units/{id}/activate', [
        'uses' => 'SWMS\SUnitsController@Activate',
        'as' => 'wms.units.activate'
      ]);
      Route::get('units/{id}/copy', [
        'uses' => 'SWMS\SUnitsController@Copy',
        'as' => 'wms.units.copy'
      ]);
      Route::resource('whs','SWMS\SWarehousesController');
      Route::get('whs/{id}/destroy',[
        'uses' => 'SWMS\SWarehousesController@Destroy',
        'as' => 'wms.whs.destroy'
      ]);
      Route::get('whs/{id}/activate', [
        'uses' => 'SWMS\SWarehousesController@Activate',
        'as' => 'wms.whs.activate'
      ]);
      Route::get('whs/{id}/copy', [
        'uses' => 'SWMS\SWarehousesController@Copy',
        'as' => 'wms.whs.copy'
      ]);

      Route::resource('locs','SWMS\SLocationsController');
      Route::get('locs/{id}/destroy',[
        'uses' => 'SWMS\SLocationsController@Destroy',
        'as' => 'wms.locs.destroy'
      ]);
      Route::get('locs/{id}/activate', [
        'uses' => 'SWMS\SLocationsController@Activate',
        'as' => 'wms.locs.activate'
      ]);
      Route::get('locs/{id}/copy', [
        'uses' => 'SWMS\SLocationsController@Copy',
        'as' => 'wms.locs.copy'
      ]);
  });


//****************************************/ Shipments /*************************
		Route::get('/tms/home',[
			'as' => 'tms.home',
			'uses' => 'STMS\SShipmentsController@Home'
		]);
		Route::resource('tms','STMS\SShipmentsController');

//****************************************/ Mrp /*************************
    Route::group(['prefix' => 'mrp'], function () {

      Route::get('/home',[
  			'as' => 'mrp.home',
  			'uses' => 'SMRP\SMRPController@Home'
  		]);
      Route::resource('central','SMRP\SMRPController');

      Route::resource('companies','SMRP\SMrpCompaniesController');
      Route::get('companies/{id}/destroy',[
        'uses' => 'SMRP\SMrpCompaniesController@Destroy',
        'as' => 'mrp.companies.destroy'
      ]);
      Route::get('companies/{id}/activate', [
        'uses' => 'SMRP\SMrpCompaniesController@Activate',
        'as' => 'mrp.companies.activate'
      ]);

      Route::resource('branches','SMRP\SBranchesController');
      Route::get('branches/{id}/destroy',[
        'uses' => 'SMRP\SBranchesController@Destroy',
        'as' => 'mrp.branches.destroy'
      ]);
      Route::get('branches/{id}/activate', [
        'uses' => 'SMRP\SBranchesController@Activate',
        'as' => 'mrp.branches.activate'
      ]);

      Route::resource('years','SMRP\SYearsController');
      Route::get('years/{id}/destroy',[
        'uses' => 'SMRP\SYearsController@Destroy',
        'as' => 'mrp.years.destroy'
      ]);
      Route::get('years/{id}/activate', [
        'uses' => 'SMRP\SYearsController@Activate',
        'as' => 'mrp.years.activate'
      ]);

      Route::get('months/{year}/edit/{month}',[
        'uses' => 'SMRP\SMonthsController@edit',
        'as' => 'mrp.months.edit'
      ]);
      Route::get('months/{year}/update/{month}',[
        'uses' => 'SMRP\SMonthsController@edit',
        'as' => 'mrp.months.update'
      ]);
      Route::get('months/{year}/index',[
        'uses' => 'SMRP\SMonthsController@index',
        'as' => 'mrp.months.index'
      ]);
      Route::put('months/{year}/update',[
        'uses' => 'SMRP\SMonthsController@Update',
        'as' => 'mrp.months.update'
      ]);

      Route::resource('bps','SMRP\SBussPartnersController');
      Route::get('bps/{id}/destroy',[
        'uses' => 'SMRP\SBussPartnersController@Destroy',
        'as' => 'mrp.bps.destroy'
      ]);
      Route::get('bps/{id}/activate', [
        'uses' => 'SMRP\SBussPartnersController@Activate',
        'as' => 'mrp.bps.activate'
      ]);
      Route::get('bps/{id}/copy', [
  			'uses' => 'SMRP\SBussPartnersController@Copy',
  			'as' => 'mrp.bps.copy'
  		]);

    });

	});
});

Route::get('auth/login', [
	'uses' => 'Auth\AuthController@getLogin',
	'as'   => 'auth.login'
]);
Route::post('auth/login', [
	'uses' => 'Auth\AuthController@postLogin',
	'as'   => 'auth.login'
]);
Route::get('auth/logout', [
	'uses' => 'Auth\AuthController@getLogout',
	'as'   => 'auth.logout'
]);
