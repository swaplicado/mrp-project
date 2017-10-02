<?php namespace App\Http\Controllers\SWMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Laracasts\Flash\Flash;
use App\SUtils\SUtil;
use App\SUtils\SMenu;
use App\SUtils\SValidation;
use App\SWMS\SWarehouse;
use App\SWMS\SLocation;

class SLocationsController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.LOCATIONS'));

       $oMenu = new SMenu(\Config::get('scperm.MODULES.WMS'), 'navbar-green');
       session(['menu' => $oMenu]);
       $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));

       $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.LOCATIONS'));

       $this->iFilter = \Config::get('scsys.FILTER.ACTIVES');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->iFilter = $request->filter == null ? \Config::get('scsys.FILTER.ACTIVES') : $request->filter;

        $lLocations = SLocation::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(20);
        $lLocations->each(function($lLocations) {
          $lLocations->warehouse;
        });

        return view('wms.locs.index')
            ->with('locations', $lLocations)
            ->with('actualUserPermission', $this->oCurrentUserPermission)
            ->with('iFilter', $this->iFilter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (SValidation::canCreate($this->oCurrentUserPermission->privilege_id))
        {
          $lWarehouses = SWarehouse::orderBy('name', 'ASC')->lists('name', 'id_whs');

          return view('wms.locs.createEdit')
                        ->with('warehouses', $lWarehouses);
        }
        else
        {
           return redirect()->route('notauthorized');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $location = new SLocation($request->all());
      
      $location->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
      $location->updated_by_id = \Auth::user()->id;
      $location->created_by_id = \Auth::user()->id;

      $location->save();

      Flash::success(trans('messages.REG_CREATED'))->important();

      return redirect()->route('wms.locs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = SLocation::find($id);

        if (SValidation::canEdit($this->oCurrentUserPermission->privilege_id) || SValidation::canAuthorEdit($this->oCurrentUserPermission->privilege_id, $location->created_by_id))
        {
          $lWarehouses = SWarehouse::orderBy('name', 'ASC')->lists('name', 'id_whs');

          return view('wms.locs.createEdit')
                      ->with('location', $location)
                      ->with('warehouses', $lWarehouses);
        }
        else
        {
            return redirect()->route('notauthorized');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location = SLocation::find($id);
        $location->fill($request->all());
        $location->updated_by_id = \Auth::user()->id;
        $location->save();

        Flash::warning(trans('messages.REG_EDITED'))->important();

        return redirect()->route('wms.locs.index');
    }

    /**
     * Inactive the registry setting the flag is_deleted to true
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function copy(Request $request, $id)
    {
        $location = SLocation::find($id);

        $locationCopy = clone $location;
        $locationCopy->id_location = 0;

        $lWarehouses = SWarehouse::orderBy('name', 'ASC')->lists('name', 'id_whs');

        return view('wms.locs.createEdit')->with('location', $locationCopy)
                                        ->with('warehouses', $lWarehouses)
                                      ->with('bIsCopy', true);
    }

    public function activate(Request $request, $id)
    {
        $location = SLocation::find($id);

        $location->fill($request->all());
        $location->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
        $location->updated_by_id = \Auth::user()->id;

        $location->save();

        Flash::success(trans('messages.REG_ACTIVATED'))->important();

        return redirect()->route('wms.locs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (SValidation::canDestroy($this->oCurrentUserPermission->privilege_id))
        {
          $location = SLocation::find($id);
          $location->fill($request->all());
          $location->is_deleted = \Config::get('scsys.STATUS.DEL');
          $location->updated_by_id = \Auth::user()->id;

          $location->save();
          #$user->delete();

          Flash::error(trans('messages.REG_DELETED'))->important();
          return redirect()->route('wms.locs.index');
        }
        else
        {
          return redirect()->route('notauthorized');
        }
    }
}
