<?php namespace App\Http\Controllers\SSYS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SUtils\SValidation;
use App\SUtils\SUtil;
use App\SSYS\SCompany;
use App\SSYS\SUserCompany;

class SStartController extends Controller
{

    public function __construct()
    {
        session()->forget('company');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lUserCompany = SUtil::getUserCompany(\Auth::user());

        return view('start.select')
                            ->with('lUserCompany', $lUserCompany);
    }

    /**
     *
     */
    public function getIn(Request $request)
    {
        $iCompanyId =  $_COOKIE['iCompanyId'];
        $oCompany = SCompany::find($iCompanyId);

        session(['company' => $oCompany]);

        $sConnection = 'siie';
        $bDefault = true;
        $sHost = $oCompany->host;
        $sDataBase = $oCompany->database_name;
        $sUser = $oCompany->database_user;
        $sPassword = $oCompany->password;

        SUtil::reconnectDataBase($sConnection, $bDefault, $sHost, $sDataBase, $sUser, $sPassword);

        return SStartController::selectModule();
    }

    /**
     *
     */
    public function selectModule()
    {
        return view('start.modules');
    }
}
