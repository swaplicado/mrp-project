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

class SMonthsController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.MONTHS'));

       $oMenu = new SMenu(\Config::get('scperm.MODULES.MRP'), 'navbar-mrp');
       session(['menu' => $oMenu]);
       $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));

       $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.MONTHS'));

       $this->iFilter = \Config::get('scsys.FILTER.ACTIVES');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $iYearId = 0)
    {
      $this->iFilter = $request->filter == null ? \Config::get('scsys.FILTER.ACTIVES') : $request->filter;
      $lMonths = SMonth::Search($this->iFilter, $iYearId)
                                              ->orderBy('id_month', 'ASC')
                                              ->paginate(12);

      return view('mrp.months.index')
          ->with('months', $lMonths)
          ->with('actualUserPermission', $this->oCurrentUserPermission)
          ->with('iFilter', $this->iFilter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $oMonth = SMonth::find($id);

      return view('mrp.months.createEdit')->with('month', $oMonth)
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
       $oMonth = SMonth::find($id);

       $oMonth->fill($request->all());
       $oMonth->updated_by_id = \Auth::user()->id;

       $oMonth->save();

       Flash::warning(trans('messages.REG_EDITED'));

       return redirect()->route('mrp.months.index', $oMonth->year_id);
     }
}
