<?php namespace App\Http\Controllers\SSIIE;

use Illuminate\Http\Request;

use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SSIIE\SYear;
use App\SSIIE\SMonth;
use App\SUtils\SUtil;
use App\SUtils\SValidation;
use App\SUtils\SMenu;

class SSiieController extends Controller
{

    public function __construct()
    {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.MODULE').','.\Config::get('scperm.MODULES.SIIE'));

       $oMenu = new SMenu(\Config::get('scperm.MODULES.SIIE'), 'navbar-siie');
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
        return view('siie.index');
    }
}
