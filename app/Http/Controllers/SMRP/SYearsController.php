<?php namespace App\Http\Controllers\SMRP;

use Illuminate\Http\Request;

use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SMRP\SYear;
use App\SMRP\SMonth;
use App\SUtils\SUtil;
use App\SUtils\SValidation;
use App\SUtils\SMenu;

class SYearsController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.YEARS'));

       $oMenu = new SMenu(\Config::get('scperm.MODULES.MRP'), 'navbar-mrp');
       session(['menu' => $oMenu]);
       $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));

       $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.YEARS'));

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
      $lYears = SYear::Search($request->name, $this->iFilter)->orderBy('id_year', 'ASC')->paginate(10);

      return view('mrp.years.index')
          ->with('years', $lYears)
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
          return view('mrp.years.createEdit');
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
        $oYear = new SYear($request->all());

        \DB::beginTransaction();
        try
        {
            $oYear->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
            $oYear->updated_by_id = \Auth::user()->id;
            $oYear->created_by_id = \Auth::user()->id;

            $oYear->save();

            for ($i = 1; $i <= 12; $i++)
            {
              $oMonth = new SMonth($i, $oYear->id_year);
              $oYear->months()->save($oMonth);
            }

            \DB::commit();
            $success = true;
        }
        catch (\Exception $e)
        {
            $success = false;
            \DB::rollback();
            dd($e);
        }

        if ($success)
        {
            Flash::success(trans('messages.REG_CREATED'))->important();
        }
        else
        {
            Flash::error(trans('messages.REG_CREATED'));
        }

        return redirect()->route('mrp.years.index');
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
      $oYear = SYear::find($id);

      return view('mrp.years.createEdit')->with('year', $oYear)
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
       $oYear = SYear::find($id);
       $oYear->fill($request->all());
       $oYear->updated_by_id = \Auth::user()->id;

       $oYear->save();

       Flash::warning(trans('messages.REG_EDITED'))->important();

       return redirect()->route('mrp.years.index');
     }

     public function activate(Request $request, $id)
     {
       $oYear = SYear::find($id);

       $oYear->fill($request->all());
       $oYear->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
       $oYear->updated_by_id = \Auth::user()->id;

       $oYear->save();

       Flash::success(trans('messages.REG_ACTIVATED'))->important();

       return redirect()->route('mrp.years.index');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
       $oYear = SYear::find($id);
       $oYear->fill($request->all());
       $oYear->is_deleted = \Config::get('scsys.STATUS.DEL');
       $oYear->updated_by_id = \Auth::user()->id;

       $oYear->save();
       #$user->delete();

       Flash::error(trans('messages.REG_DELETED'))->important();

       return redirect()->route('mrp.years.index');
     }
}
