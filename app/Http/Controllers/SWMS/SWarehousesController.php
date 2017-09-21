<?php namespace App\Http\Controllers\SWMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Laracasts\Flash\Flash;
use App\SUtils\SUtil;
use App\SUtils\SMenu;
use App\SUtils\SValidation;
use App\SWMS\SWarehouse;
use App\SWMS\SWhsType;
use App\SMRP\SBranch;

class SWarehousesController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.WAREHOUSES'));

       $oMenu = new SMenu(\Config::get('scperm.MODULES.WMS'), 'navbar-green');
       session(['menu' => $oMenu]);
       $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));

       $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.WAREHOUSES'));

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

      $lWarehouses = SWarehouse::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(20);
      $lWarehouses->each(function($lWarehouses) {
        $lWarehouses->branch;
      });

      return view('wms.whs.index')
          ->with('warehouses', $lWarehouses)
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
          $lTypes = SWhsType::orderBy('name', 'ASC')->lists('name', 'id_type');
          $lBranches = SBranch::orderBy('name', 'ASC')->lists('name', 'id_branch');

          return view('wms.whs.createEdit')
                        ->with('branches', $lBranches)
                        ->with('types', $lTypes);
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
      $whs = new SWarehouse($request->all());

      $whs->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
      $whs->updated_by_id = \Auth::user()->id;
      $whs->created_by_id = \Auth::user()->id;

      $whs->save();

      Flash::success(trans('messages.REG_CREATED'));

      return redirect()->route('wms.whs.index');
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
        $whs = SWarehouse::find($id);

        if (SValidation::canEdit($this->oCurrentUserPermission->privilege_id) || SValidation::canAuthorEdit($this->oCurrentUserPermission->privilege_id, $whs->created_by_id))
        {
          $lTypes = SWhsType::orderBy('name', 'ASC')->lists('name', 'id_type');
          $lBranches = SBranch::orderBy('name', 'ASC')->lists('name', 'id_branch');

          return view('wms.whs.createEdit')
                      ->with('whs', $whs)
                      ->with('branches', $lBranches)
                      ->with('types', $lTypes);
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
        $whs = SWarehouse::find($id);
        $whs->fill($request->all());
        $whs->updated_by_id = \Auth::user()->id;
        $whs->save();

        Flash::warning(trans('messages.REG_EDITED'));

        return redirect()->route('wms.whs.index');
    }

    /**
     * Inactive the registry setting the flag is_deleted to true
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function copy(Request $request, $id)
    {
        $whs = SWarehouse::find($id);

        $whsCopy = clone $whs;
        $whsCopy->id_whs = 0;

        $lTypes = SWhsType::orderBy('name', 'ASC')->lists('name', 'id_type');
        $lBranches = SBranch::orderBy('name', 'ASC')->lists('name', 'id_branch');

        return view('wms.whs.createEdit')->with('whs', $whsCopy)
                                        ->with('branches', $lBranches)
                                        ->with('types', $lTypes)
                                        ->with('bIsCopy', true);
    }

    public function activate(Request $request, $id)
    {
        $whs = SWarehouse::find($id);

        $whs->fill($request->all());
        $whs->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
        $whs->updated_by_id = \Auth::user()->id;

        $whs->save();

        Flash::success(trans('messages.REG_ACTIVATED'));

        return redirect()->route('wms.whs.index');
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
          $whs = SWarehouse::find($id);
          $whs->fill($request->all());
          $whs->is_deleted = \Config::get('scsys.STATUS.DEL');
          $whs->updated_by_id = \Auth::user()->id;

          $whs->save();
          #$user->delete();

          Flash::error(trans('messages.REG_DELETED'));
          return redirect()->route('wms.whs.index');
        }
        else
        {
          return redirect()->route('notauthorized');
        }
    }
}
