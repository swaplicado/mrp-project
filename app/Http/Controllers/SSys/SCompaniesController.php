<?php namespace App\Http\Controllers\SSys;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SSys\SCompany;
use Laracasts\Flash\Flash;

class SCompaniesController extends Controller
{
      private $iFilter;

      public function __construct()
      {
         $this->middleware('mdadmin');
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
         $lCompanies = SCompany::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(10);

         return view('companies.index')
             ->with('companies', $lCompanies)
             ->with('actualUserPermission', NULL)
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
      $company = SCompany::find($id);

      return view('companies.edit')->with('company', $company)
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
      $company = SCompany::find($id);
      $company->fill($request->all());
      $company->updated_by_id = \Auth::user()->id;
      $company->save();

      Flash::warning(trans('messages.REG_EDITED'))->important();

      return redirect()->route('companies.index');
    }


    public function activate(Request $request, $id)
    {
      $company = SCompany::find($id);

      $company->fill($request->all());
      $company->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
      $company->updated_by_id = \Auth::user()->id;

      $company->save();

      Flash::success(trans('messages.REG_ACTIVATED'))->important();

      return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $company = SCompany::find($id);
      $company->fill($request->all());
      $company->is_deleted = \Config::get('scsys.STATUS.DEL');
      $company->updated_by_id = \Auth::user()->id;

      $company->save();
      #$user->delete();

      Flash::error(trans('messages.REG_DELETED'))->important();

      return redirect()->route('companies.index');
    }
}
