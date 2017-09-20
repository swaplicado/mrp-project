<?php namespace App\Http\Controllers\SWMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SUtils\SUtil;
use App\SUtils\SMenu;
use App\SUtils\SValidation;
use App\SWMS\SUnit;

class SUnitsController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.UNITS'));

       $oMenu = new SMenu(\Config::get('scperm.MODULES.WMS'), 'navbar-green');
       session(['menu' => $oMenu]);
       $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));

       $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.UNITS'));

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

      $lUnits = SUnit::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(20);
      $lUnits->each(function($lUnits) {
        $lUnits->equivalence;
      });

      return view('wms.units.index')
          ->with('units', $lUnits)
          ->with('actualUserPermission', $this->oCurrentUserPermission)
          ->with('sClassNav', (session()->has('menu') ? session('menu')->getClassNav() : ''))
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
          $unitsEq = SUnit::orderBy('name', 'ASC')->lists('name', 'id_unit');

          return view('wms.units.createEdit')->with('unitseq', $unitsEq);
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
      $unit = new SUnit($request->all());

      $unit->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
      $unit->updated_by_id = \Auth::user()->id;
      $unit->created_by_id = \Auth::user()->id;

      $unit->save();

      Flash::success(trans('messages.REG_CREATED'));

      return redirect()->route('wms.units.index');
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
        $unit = SUnit::find($id);

        if (SValidation::canEdit($this->oCurrentUserPermission->privilege_id) || SValidation::canAuthorEdit($this->oCurrentUserPermission->privilege_id, $unit->created_by_id))
        {
            $unitsEq = SUnit::orderBy('name', 'ASC')->lists('name', 'id_unit');

            return view('wms.units.createEdit')->with('unit', $unit)
                                            ->with('unitseq', $unitsEq);
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
        $unit = SUnit::find($id);
        $unit->fill($request->all());
        $unit->updated_by_id = \Auth::user()->id;
        $unit->save();

        Flash::warning(trans('messages.REG_EDITED'));

        return redirect()->route('wms.units.index');
    }

    /**
     * Inactive the registry setting the flag is_deleted to true
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function copy(Request $request, $id)
    {
        $unit = SUnit::find($id);

        $unitCopy = clone $unit;
        $unitCopy->id_bp = 0;

        return view('wms.units.createEdit')->with('unit', $unitCopy)
                                      ->with('bIsCopy', true);
    }

    public function activate(Request $request, $id)
    {
        $unit = SUnit::find($id);

        $unit->fill($request->all());
        $unit->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
        $unit->updated_by_id = \Auth::user()->id;

        $unit->save();

        Flash::success(trans('messages.REG_ACTIVATED'));

        return redirect()->route('wms.units.index');
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
          $unit = SUnit::find($id);
          $unit->fill($request->all());
          $unit->is_deleted = \Config::get('scsys.STATUS.DEL');
          $unit->updated_by_id = \Auth::user()->id;

          $unit->save();
          #$user->delete();

          Flash::error(trans('messages.REG_DELETED'));
          return redirect()->route('wms.units.index');
        }
        else
        {
          return redirect()->route('notauthorized');
        }
    }
}
