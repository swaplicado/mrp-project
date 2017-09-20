<?php namespace App\Http\Controllers\SMMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SUtils\SUtil;
use App\SUtils\SMenu;

class SProductionController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.MODULE').','.\Config::get('scperm.MODULES.MMS'));
       $oMenu = new SMenu(\Config::get('scperm.MODULES.MMS'), 'navbar-blue');
       session(['menu' => $oMenu]);

       $this->middleware('mdmenu:'.(session()->has('menu') ? session('menu')->getMenu() : \Config::get('scsys.UNDEFINED')));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('mms.index');
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
