<?php namespace App\Http\Controllers\SWMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Laracasts\Flash\Flash;
use App\SUtils\SUtil;
use App\SUtils\SMenu;
use App\SUtils\SValidation;
use App\SWMS\SItemFamily;

class SFamiliesController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.ITM_FAM'));

       $oMenu = new SMenu(\Config::get('scperm.MODULES.WMS'), 'navbar-green');
       session(['menu' => $oMenu]);
       $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));

       $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.ITM_FAM'));

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

      $lFamilies = SItemFamily::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(20);

      return view('wms.families.index')
          ->with('families', $lFamilies)
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
          return view('wms.families.createEdit');
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
      $family = new SItemFamily($request->all());

      $family->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
      $family->updated_by_id = \Auth::user()->id;
      $family->created_by_id = \Auth::user()->id;

      $family->save();

      Flash::success(trans('messages.REG_CREATED'))->important();

      return redirect()->route('wms.families.index');
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
        $family = SItemFamily::find($id);

        if (SValidation::canEdit($this->oCurrentUserPermission->privilege_id) || SValidation::canAuthorEdit($this->oCurrentUserPermission->privilege_id, $family->created_by_id))
        {
            return view('wms.families.createEdit')->with('family', $family);
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
        $family = SItemFamily::find($id);
        $family->fill($request->all());
        $family->updated_by_id = \Auth::user()->id;
        $family->save();

        Flash::warning(trans('messages.REG_EDITED'))->important();

        return redirect()->route('wms.families.index');
    }

    /**
     * Inactive the registry setting the flag is_deleted to true
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function copy(Request $request, $id)
    {
        $family = SItemFamily::find($id);

        $familyCopy = clone $family;
        $familyCopy->id_family = 0;

        return view('wms.families.createEdit')->with('family', $familyCopy)
                                              ->with('bIsCopy', true);
    }

    public function activate(Request $request, $id)
    {
        $family = SItemFamily::find($id);

        $family->fill($request->all());
        $family->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
        $family->updated_by_id = \Auth::user()->id;

        $family->save();

        Flash::success(trans('messages.REG_ACTIVATED'))->important();

        return redirect()->route('wms.families.index');
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
          $family = SItemFamily::find($id);
          $family->fill($request->all());
          $family->is_deleted = \Config::get('scsys.STATUS.DEL');
          $family->updated_by_id = \Auth::user()->id;

          $family->save();
          #$user->delete();

          Flash::error(trans('messages.REG_DELETED'))->important();
          return redirect()->route('wms.families.index');
        }
        else
        {
          return redirect()->route('notauthorized');
        }
    }
}
