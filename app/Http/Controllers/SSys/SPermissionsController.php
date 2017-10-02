<?php namespace App\Http\Controllers\SSys;

use Illuminate\Http\Request;
use App\SSys\SPermission;
use App\SSys\SPermissionType;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\SUtils\SValidation;
use App\SUtils\SUtil;

class SPermissionsController extends Controller
{
      private $oCurrentUserPermission;
      private $iFilter;

      public function __construct()
      {
           $this->middleware('mdadmin');
           $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.PERMISSIONS'));
           $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.PERMISSIONS'));

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
        $permissions = SPermission::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(10);

        return view('permissions.index')
                    ->with('permissions', $permissions)
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
              $lPermissionTypes = SPermissionType::orderBy('name', 'ASC')->lists('name', 'id_type');

              return view('permissions.createEdit')->with('types', $lPermissionTypes);
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
        $permission = new SPermission($request->all());
        $permission->save();

        Flash::success(trans('messages.REG_CREATED'))->important();

        return redirect()->route('permissions.index');
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
        $permission = SPermission::find($id);
        $lPermissionTypes = SPermissionType::orderBy('name', 'ASC')->lists('name', 'id_type');

        if (SValidation::canEdit($this->oCurrentUserPermission->privilege_id) || SValidation::canAuthorEdit($this->oCurrentUserPermission->privilege_id, $permission->created_by_id))
        {
          return view('permissions.createEdit')->with('permission', $permission)
                                               ->with('types', $lPermissionTypes)
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
        $permission = SPermission::find($id);
        $permission->fill($request->all());
        $permission->save();

        Flash::warning(trans('messages.REG_EDITED'))->important();
        return redirect()->route('permissions.index');
    }

    public function activate(Request $request, $id)
    {
        $permission = SPermission::find($id);
        $permission->fill($request->all());
        $permission->is_deleted = \Config::get('scsys.STATUS.ACTIVE');

        $permission->save();

        Flash::success("Se ha activado de forma exitosa!");

        return redirect()->route('permissions.index');
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
          $permission = SPermission::find($id);

          $permission->fill($request->all());
          $permission->is_deleted = \Config::get('scsys.STATUS.DEL');

          $permission->save();
          #$permission->delete();
          Flash::error(trans('messages.REG_DELETED'))->important();

          return redirect()->route('permissions.index');
        }
        else
        {
          return redirect()->route('notauthorized');
        }
    }
}
