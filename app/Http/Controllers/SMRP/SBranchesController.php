<?php namespace App\Http\Controllers\SMRP;

use Illuminate\Http\Request;

use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SMRP\SBranch;
use App\SMRP\SMrpCompany;
use App\SUtils\SValidation;
use App\SUtils\SUtil;
use App\SUtils\SMenu;

class SBranchesController extends Controller {

    private $oCurrentUserPermission;
    private $iFilter;
    private $sClassNav;

    public function __construct()
    {
         $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.BRANCHES'));

         $oMenu = new SMenu(\Config::get('scperm.MODULES.MRP'), 'navbar-mrp');
         session(['menu' => $oMenu]);
         $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));

         $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.BRANCHES'));

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
      $lBranches = SBranch::Search($request->name, $this->iFilter)->orderBy('code', 'ASC')->paginate(10);

      $lBranches->each(function($lBranches) {
        $lBranches->company;
      });

      return view('mrp.branches.index')
          ->with('branches', $lBranches)
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
          $companies = SMrpCompany::orderBy('name', 'ASC')->lists('name', 'id_company');

          return view('mrp.branches.createEdit')
                        ->with('companies', $companies);
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
        $company = SMrpCompany::find(1);

        $branch = new SBranch($request->all());

        $branch->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
        $branch->company_id = $company->id_company;
        $branch->updated_by_id = \Auth::user()->id;
        $branch->created_by_id = \Auth::user()->id;

        $branch->save();

        Flash::success(trans('messages.REG_CREATED'))->important();

        return redirect()->route('mrp.branches.index');
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
        $branch = SBranch::find($id);

        return view('mrp.branches.createEdit')->with('branch', $branch)
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
         $branch = SBranch::find($id);
         $branch->fill($request->all());
         $branch->updated_by_id = \Auth::user()->id;
         $branch->save();

         Flash::warning(trans('messages.REG_EDITED'))->important();

         return redirect()->route('mrp.branches.index');
     }


     public function activate(Request $request, $id)
     {
         $branch = SBranch::find($id);

         $branch->fill($request->all());
         $branch->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
         $branch->updated_by_id = \Auth::user()->id;

         $branch->save();

         Flash::success(trans('messages.REG_ACTIVATED'))->important();

         return redirect()->route('mrp.branches.index');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
         $branch = SBranch::find($id);
         $branch->fill($request->all());
         $branch->is_deleted = \Config::get('scsys.STATUS.DEL');
         $branch->updated_by_id = \Auth::user()->id;

         $branch->save();
         #$user->delete();

         Flash::error(trans('messages.REG_DELETED'))->important();

         return redirect()->route('mrp.branches.index');
     }
}
