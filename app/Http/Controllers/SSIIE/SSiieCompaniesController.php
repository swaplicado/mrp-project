<?php namespace App\Http\Controllers\SSIIE;

use Illuminate\Http\Request;

use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SSIIE\SSiieCompany;
use App\SUtils\SUtil;
use App\SUtils\SMenu;

class SSiieCompaniesController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.SIIE_COMPANIES'));

       $oMenu = new SMenu(\Config::get('scperm.MODULES.SIIE'), 'navbar-siie');
       session(['menu' => $oMenu]);
       $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));

       $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.SIIE_COMPANIES'));

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
      $lCompanies = SSiieCompany::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(10);

      return view('siie.companies.index')
          ->with('companies', $lCompanies)
          ->with('actualUserPermission', $this->oCurrentUserPermission)
          ->with('iFilter', $this->iFilter);
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
      $company = SSiieCompany::find($id);

      return view('siie.companies.edit')->with('company', $company)
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
       $company = SSiieCompany::find($id);
       $company->fill($request->all());
       $company->updated_by_id = \Auth::user()->id;
       $company->save();

       Flash::warning(trans('messages.REG_EDITED'))->important();

       return redirect()->route('siie.companies.index');
     }

     public function activate(Request $request, $id)
     {
       $company = SSiieCompany::find($id);

       $company->fill($request->all());
       $company->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
       $company->updated_by_id = \Auth::user()->id;

       $company->save();

       Flash::success(trans('messages.REG_ACTIVATED'))->important();

       return redirect()->route('siie.companies.index');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
       $company = SSiieCompany::find($id);
       $company->fill($request->all());
       $company->is_deleted = \Config::get('scsys.STATUS.DEL');
       $company->updated_by_id = \Auth::user()->id;

       $company->save();
       #$user->delete();

       Flash::error(trans('messages.REG_DELETED'))->important();

       return redirect()->route('siie.companies.index');
     }
}
