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

	Route::resource('start','SSYS\SStartController');
	Route::get('/start',[
		'as' => 'start',
		'uses' => 'SSYS\SStartController@index'
	]);
	Route::post('/start/in',[
		'as' => 'start.getIn',
		'uses' => 'SSYS\SStartController@GetIn'
	]);

//****************************************/ Admin/*************************
	Route::group(['middleware' => ['mdadmin']], function() {

		Route::get('/admin',[
			'as' => 'plantilla.admin',
			'uses' => 'SPlantillaController@index'
		]);

  Route::group(['prefix' => 'admin'], function () {
  		Route::resource('users','SUsersController');
  		Route::get('users/{id}/activate', [
  			'uses' => 'SUsersController@Activate',
  			'as' => 'admin.users.activate'
  		]);
  		Route::get('users/{id}/copy', [
  			'uses' => 'SUsersController@Copy',
  			'as' => 'admin.users.copy'
  		]);
  		Route::get('users/{id}/destroy',[
  			'uses' => 'SUsersController@Destroy',
  			'as' => 'admin.users.destroy'
  		]);

  		Route::resource('privileges','SSYS\SPrivilegesController');
  		Route::get('privileges/{id}/activate', [
  			'uses' => 'SSYS\SPrivilegesController@Activate',
  			'as' => 'admin.privileges.activate'
  		]);
  		Route::get('privileges/{id}/destroy',[
  			'uses' => 'SSYS\SPrivilegesController@Destroy',
  			'as' => 'admin.privileges.destroy'
  		]);

  		Route::resource('permissions','SSYS\SPermissionsController');
  		Route::get('permissions/{id}/activate', [
  			'uses' => 'SSYS\SPermissionsController@Activate',
  			'as' => 'admin.permissions.activate'
  		]);
  		Route::get('permissions/{id}/destroy',[
  			'uses' => 'SSYS\SPermissionsController@Destroy',
  			'as' => 'admin.permissions.destroy'
  		]);

  		Route::resource('userPermissions','SSYS\SUserPermissionsController');
  		Route::get('userPermissions/{id}/activate', [
  			'uses' => 'SSYS\SUserPermissionsController@Activate',
  			'as' => 'admin.userPermissions.activate'
  		]);
  		Route::get('userPermissions/{id}/destroy',[
  			'uses' => 'SSYS\SUserPermissionsController@Destroy',
  			'as' => 'admin.userPermissions.destroy'
  		]);

      Route::resource('companies','SSYS\SCompaniesController');
      Route::get('companies/{id}/destroy',[
  			'uses' => 'SSYS\SCompaniesController@Destroy',
  			'as' => 'admin.companies.destroy'
  		]);
      Route::get('companies/{id}/activate', [
  			'uses' => 'SSYS\SCompaniesController@Activate',
  			'as' => 'admin.companies.activate'
  		]);
    });

	});

//****************************************/ Company /*************************

	Route::group(['middleware' => ['mdcompany']], function() {

		Route::get('/modules',[
			'as' => 'start.selmod',
			'uses' => 'SSYS\SStartController@SelectModule'
		]);

//****************************************/ Manufacturing /*************************
		Route::get('/mms/home',[
			'as' => 'mms.home',
			'uses' => 'SMMS\SProductionController@Home'
		]);
		Route::resource('mms','SMMS\SProductionController');

//****************************************/ Quality Module /*************************
		Route::get('/qms/home',[
			'as' => 'qms.home',
			'uses' => 'SQMS\SQualityController@Home'
		]);
		Route::resource('qms','SQMS\SQualityController');

//****************************************/ Warehouses Module/*************************

  Route::group(['prefix' => 'wms'], function () {
  		Route::get('/home',[
  			'as' => 'wms.home',
  			'uses' => 'SWMS\SWmsController@Home'
  		]);
  		Route::resource('wms','SWMS\SWmsController');

      /*
      * Units
      **/

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

      /*
      * Warehouses
      **/
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

      /*
      * Locations
      **/
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

      /*
      * Families
      **/
      Route::resource('families','SWMS\SFamiliesController');
      Route::get('families/{id}/destroy',[
        'uses' => 'SWMS\SFamiliesController@Destroy',
        'as' => 'wms.families.destroy'
      ]);
      Route::get('families/{id}/activate', [
        'uses' => 'SWMS\SFamiliesController@Activate',
        'as' => 'wms.families.activate'
      ]);
      Route::get('families/{id}/copy', [
        'uses' => 'SWMS\SFamiliesController@Copy',
        'as' => 'wms.families.copy'
      ]);

      /*
      * Groups
      **/
      Route::resource('groups','SWMS\SGroupsController');
      Route::get('groups/{id}/destroy',[
        'uses' => 'SWMS\SGroupsController@Destroy',
        'as' => 'wms.groups.destroy'
      ]);
      Route::get('groups/{id}/activate', [
        'uses' => 'SWMS\SGroupsController@Activate',
        'as' => 'wms.groups.activate'
      ]);
      Route::get('groups/{id}/copy', [
        'uses' => 'SWMS\SGroupsController@Copy',
        'as' => 'wms.groups.copy'
      ]);
  });


//****************************************/ Shipments /*************************
		Route::get('/tms/home',[
			'as' => 'tms.home',
			'uses' => 'STMS\SShipmentsController@Home'
		]);
		Route::resource('tms','STMS\SShipmentsController');

//****************************************/ Siie /*************************
    Route::group(['prefix' => 'siie'], function () {

      Route::get('/home',[
  			'as' => 'siie.home',
  			'uses' => 'SSIIE\SSIIEController@Home'
  		]);
      Route::resource('central','SSIIE\SSiieController');

      Route::resource('companies','SSIIE\SSiieCompaniesController');
      Route::get('companies/{id}/destroy',[
        'uses' => 'SSIIE\SSiieCompaniesController@Destroy',
        'as' => 'siie.companies.destroy'
      ]);
      Route::get('companies/{id}/activate', [
        'uses' => 'SSIIE\SSiieCompaniesController@Activate',
        'as' => 'siie.companies.activate'
      ]);

      Route::resource('branches','SSIIE\SBranchesController');
      Route::get('branches/{id}/destroy',[
        'uses' => 'SSIIE\SBranchesController@Destroy',
        'as' => 'siie.branches.destroy'
      ]);
      Route::get('branches/{id}/activate', [
        'uses' => 'SSIIE\SBranchesController@Activate',
        'as' => 'siie.branches.activate'
      ]);

      Route::resource('years','SSIIE\SYearsController');
      Route::get('years/{id}/destroy',[
        'uses' => 'SSIIE\SYearsController@Destroy',
        'as' => 'siie.years.destroy'
      ]);
      Route::get('years/{id}/activate', [
        'uses' => 'SSIIE\SYearsController@Activate',
        'as' => 'siie.years.activate'
      ]);

      Route::get('months/{year}/edit/{month}',[
        'uses' => 'SSIIE\SMonthsController@edit',
        'as' => 'siie.months.edit'
      ]);
      Route::get('months/{year}/update/{month}',[
        'uses' => 'SSIIE\SMonthsController@edit',
        'as' => 'siie.months.update'
      ]);
      Route::get('months/{year}/index',[
        'uses' => 'SSIIE\SMonthsController@index',
        'as' => 'siie.months.index'
      ]);
      Route::put('months/{year}/update',[
        'uses' => 'SSIIE\SMonthsController@Update',
        'as' => 'siie.months.update'
      ]);

      Route::resource('bps','SSIIE\SBussPartnersController');
      Route::get('bps/{id}/destroy',[
        'uses' => 'SSIIE\SBussPartnersController@Destroy',
        'as' => 'siie.bps.destroy'
      ]);
      Route::get('bps/{id}/activate', [
        'uses' => 'SSIIE\SBussPartnersController@Activate',
        'as' => 'siie.bps.activate'
      ]);
      Route::get('bps/{id}/copy', [
  			'uses' => 'SSIIE\SBussPartnersController@Copy',
  			'as' => 'siie.bps.copy'
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
