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

class SMRPController extends Controller
{

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.MODULE').','.\Config::get('scperm.MODULES.MRP'));

       $oMenu = new SMenu(\Config::get('scperm.MODULES.MRP'), 'navbar-mrp');
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
        return view('mrp.index');
    }
}
