<?php namespace App\Http\Controllers\SSYS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SSYS\SUserCompany;
use App\SSYS\SUser;
use App\SSYS\SCompany;

class SUserCompanyController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdadmin');
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.ACCESS'));
       $this->oCurrentUserPermission = SUtil::getTheUserPermission(\Auth::user()->id, \Config::get('scperm.VIEW_CODE.ACCESS'));

       $this->iFilter = \Config::get('scsys.FILTER.ACTIVES');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->iFilter = $request->filter == null ? \Config::get('scsys.FILTER.ACTIVES') : $request->filter;
      $userCompany = SUserCompany::Search($this->iFilter)->orderBy('name', 'ASC')->paginate(4);

      $userCompany->each(function($userCompany) {
        $userCompany->user;
        $userCompany->company;
      });

      return view('userCompany.index')
                          ->with('userCompany', $userCompany)
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
          $users = SUser::orderBy('username', 'ASC')->lists('username', 'id');
          $companies = SCompany::orderBy('name', 'ASC')->lists('name', 'id_company');

          return view('userCompany.createEdit')
                      ->with('userCompany', $users)
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
        $userCompany = new SUserCompany($request->all());
        $userCompany->created_by_id = \Auth::user()->id;

        $userCompany->save();

        Flash::success(trans('messages.REG_CREATED'))->important();

        return redirect()->route('userCompany.index');
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
          $userCompany = SUserCompany::find($id);

          if (SValidation::canEdit($this->oCurrentUserPermission->privilege_id) || SValidation::canAuthorEdit($this->oCurrentUserPermission->privilege_id, $userCompany->created_by_id))
          {
              $assignament->user;
              $userCompany->company;

              $users = SUser::orderBy('username', 'ASC')->lists('username', 'id');
              $companies = SCompany::orderBy('name', 'ASC')->lists('name', 'id_company');

              return view('userCompany.createEdit')
                ->with('userCompany', $userCompany)
                ->with('users', $users)
                ->with('companies', $companies);
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
      $userCompany = SUserCompany::find($id);
      $userCompany->fill($request->all());
      $userCompany->save();

      Flash::success(trans('messages.REG_EDITED'));

      return redirect()->route('userCompany.index');
    }


    public function activate(Request $request, $id)
    {
      $userCompany = SUserCompany::find($id);

      $userCompany->fill($request->all());
      $userCompany->is_deleted = \Config::get('scsys.STATUS.ACTIVE');

      $userCompany->save();

      Flash::success(trans('messages.REG_ACTIVATED'))->important();

      return redirect()->route('userCompany.index');
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
            $userCompany = SUserCompany::find($id);

            $userCompany->fill($request->all());
            $userCompany->is_deleted = \Config::get('scsys.STATUS.DEL');

            $userCompany->save();
            #$userCompany->delete();
            Flash::error(trans('messages.REG_DELETED'))->important();

            return redirect()->route('userCompany.index');
        }
        else
        {
            return redirect()->route('notauthorized');
        }
    }
}
