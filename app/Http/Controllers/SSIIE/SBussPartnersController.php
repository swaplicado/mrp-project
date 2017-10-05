<?php namespace App\Http\Controllers\SSIIE;

use Illuminate\Http\Request;

use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SSIIE\SBussPartner;
use App\SUtils\SValidation;
use App\SUtils\SUtil;
use App\SUtils\SMenu;

class SBussPartnersController extends Controller {

    private $oCurrentUserPermission;
    private $iFilter;
    private $iFilterBp;
    private $sClassNav;

    public function __construct()
    {
         $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.BPS'));

         $oMenu = new SMenu(\Config::get('scperm.MODULES.SIIE'), 'navbar-siie');
         session(['menu' => $oMenu]);
         $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));

         $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.BPS'));

         $this->iFilter = \Config::get('scsys.FILTER.ACTIVES');
         $this->iFilterBp = \Config::get('scsiie.ATT.ALL');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $this->iFilter = $request->filter == null ? \Config::get('scsys.FILTER.ACTIVES') : $request->filter;
      $this->iFilterBp = $request->filterBp == null ? \Config::get('scsiie.ATT.ALL') : $request->filterBp;

      $lBPartners = SBussPartner::Search($request->name, $this->iFilter, $this->iFilterBp)->orderBy('bp_name', 'ASC')->paginate(10);

      return view('siie.bps.index')
          ->with('bps', $lBPartners)
          ->with('actualUserPermission', $this->oCurrentUserPermission)
          ->with('iFilter', $this->iFilter)
          ->with('iFilterBp', $this->iFilterBp);
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
          return view('siie.bps.createEdit');
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
        $bpartner = new SBussPartner($request->all());

        $bpartner->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
        $bpartner->updated_by_id = \Auth::user()->id;
        $bpartner->created_by_id = \Auth::user()->id;

        $bpartner->save();

        Flash::success(trans('messages.REG_CREATED'))->important();

        return redirect()->route('siie.bps.index');
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
        $bpartner = SBussPartner::find($id);

        return view('siie.bps.createEdit')->with('bpartner', $bpartner)
                                      ->with('iFilter', $this->iFilter);
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
         $bpartner = SBussPartner::find($id);
         $bpartner->fill($request->all());
         $bpartner->updated_by_id = \Auth::user()->id;
         $bpartner->save();

         Flash::warning(trans('messages.REG_EDITED'))->important();

         return redirect()->route('siie.bps.index');
     }

     /**
      * Inactive the registry setting the flag is_deleted to true
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      */
     public function copy(Request $request, $id)
     {
         $bpartner = SBussPartner::find($id);

         $bpartnerCopy = clone $bpartner;
         $bpartnerCopy->id_bp = 0;

         return view('siie.bps.createEdit')->with('bpartner', $bpartnerCopy)
                                       ->with('bIsCopy', true);
     }


     public function activate(Request $request, $id)
     {
         $bpartner = SBussPartner::find($id);

         $bpartner->fill($request->all());
         $bpartner->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
         $bpartner->updated_by_id = \Auth::user()->id;

         $bpartner->save();

         Flash::success(trans('messages.REG_ACTIVATED'))->important();

         return redirect()->route('siie.bps.index');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
         $bpartner = SBussPartner::find($id);
         $bpartner->fill($request->all());
         $bpartner->is_deleted = \Config::get('scsys.STATUS.DEL');
         $bpartner->updated_by_id = \Auth::user()->id;

         $bpartner->save();

         Flash::error(trans('messages.REG_DELETED'))->important();

         return redirect()->route('siie.bps.index');
     }
}
