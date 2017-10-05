<?php namespace App\Http\Controllers\SSYS;

use Illuminate\Http\Request;
use App\SSYS\SPrivilege;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;
use App\SUtils\SValidation;
use App\SUtils\SUtil;

class SPrivilegesController extends Controller
{
      private $oCurrentUserPermission;
      private $iFilter;

      public function __construct()
      {
           $this->middleware('mdadmin');
           $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.PRIVILEGES'));
           $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.PRIVILEGES'));

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
        $privileges = SPrivilege::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(4);

        return view('admin.privileges.index')
                  ->with('privileges', $privileges)
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
          return view('admin.privileges.createEdit');
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
        $privilege = new SPrivilege($request->all());
        $privilege->save();

        Flash::success(trans('messages.REG_CREATED'))->important();

        return redirect()->route('admin.privileges.index');
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
        $privilege = SPrivilege::find($id);

        if (SValidation::canEdit($this->oCurrentUserPermission->privilege_id) || SValidation::canAuthorEdit($this->oCurrentUserPermission->privilege_id, $privilege->created_by))
        {
          return view('admin.privileges.createEdit')
                                              ->with('privilege', $privilege)
                                              ->with('iFilter', $this->iFilter);
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
        $privilege = SPrivilege::find($id);
        $privilege->fill($request->all());
        $privilege->save();

        Flash::warning(trans('messages.REG_EDITED'))->important();
        return redirect()->route('admin.privileges.index');
    }

    public function activate(Request $request, $id)
    {
      $privilege = SPrivilege::find($id);

      $privilege->fill($request->all());
      $privilege->is_deleted = \Config::get('scsys.STATUS.ACTIVE');

      $privilege->save();

      Flash::success(trans('messages.REG_ACTIVATED'))->important();

      return redirect()->route('admin.privileges.index');
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
        $privilege = SPrivilege::find($id);

        $privilege->fill($request->all());
        $privilege->is_deleted = \Config::get('scsys.STATUS.DEL');

        $privilege->save();
        #$privilege->delete();
        Flash::error(trans('messages.REG_DELETED'))->important();

        return redirect()->route('admin.privileges.index');
      }
      else
      {
        return redirect()->route('notauthorized');
      }
    }
}
