<?php namespace App\Http\Controllers\SQMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SUtils\SUtil;

class SQualityController extends Controller
{
    private $oUtil;
    private $oCurrentAssignament;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdmodule:'.\Config::get('constants.MODULES.QMS'));

       $this->middleware('mdmenu:'.\Config::get('constants.MODULES.QMS'));
       
       $this->oUtil = new SUtil();
       $this->oCurrentUserPermission = $this->oUtil->getTheUserPermission(\Auth::user()->id, \Config::get('constants.VIEW_CODE.QUALITY'));

       $this->iFilter = \Config::get('constants.FILTER.ACTIVES');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {

        $sClassNav = 'navbar-orange';

        return view('wms.index')->with('sClassNav', $sClassNav);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

    }

    public function activate(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

    }
}
