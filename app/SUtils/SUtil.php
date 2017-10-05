<?php namespace App\SUtils;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SSYS\SUserPermission;
use App\SSYS\SUserCompany;
use App\SSYS\SCompany;

class SUtil {

  public function __construct()
  {

  }

  /**
   * Return an UserPermission object with the privileges assigned.
   * If the type user is ADMIN returns an UserPermission object with all the privileges.
   *
   * @param  int  $identifier
   * @param  int  $id_user
   * @return App\SSYS\UserPermission
   */
  public static function getTheUserPermission($id_user, $identifier)
  {
      \Config::set('database.connections.siie.database', session()->has('company') ? session('company')->database_name : "");
      
      if (\Auth::check() && \Auth::user()->user_type_id == \Config::get('scsys.TP_USER.ADMIN'))
      {
          $userPermission = new SUserPermission();
          $userPermission->id_usr_per = 0;
          $userPermission->privilege_id = \Config::get('scsys.PRIVILEGES.MANAGER');
          $userPermission->permission_id = $identifier;
          $userPermission->user_id = \Auth::user()->id;
      }
      else
      {
          $userPermission = SUserPermission::where('user_id', $id_user)
                                  ->where('permission_id', $identifier)->first();
      }

      return $userPermission;
  }

  /**
   * Return a list of UserCompany objects corresponding to the user.
   *
   * @param  int  $iUserId
   * @return list of App\SSYS\UserCompany
   */
  public static function getUserCompany($oUser)
  {
      $lUserCompany = array();

      if ($oUser->user_type_id == \Config::get('scsys.TP_USER.ADMIN'))
      {
        $lCompanies = SCompany::where('is_deleted', 0)->paginate(10);

        $i = 0;
        foreach ($lCompanies as $oCompany) {
          $oUserCompany = new SUserCompany();
          $oUserCompany->company_id = $oCompany->id_company;
          $lUserCompany[$i] = $oUserCompany;
          $i++;
        }
      }
      else
      {
        $lUserCompany = SUserCompany::where('user_id', '=', $oUser->id)->paginate(10);
      }

      foreach($lUserCompany as $UC) {
        $UC->company;
      }

      return $lUserCompany;
  }

  /**
   * make the reconnection to database.
   *
   * @param  int  $sConnectionName
   * @param  int  $sHost
   * @param  int  $sDataBase
   * @param  int  $sUser
   * @param  int  $sPassword
   *
   * @return list of App\SSYS\UserCompany
   */
  public static function reconnectDataBase($sConnectionName, $bDefault, $sHost, $sDataBase, $sUser, $sPassword)
  {
      if ($sHost != NULL)
      {
        \Config::set('database.connections.'.$sConnectionName.'.host', $sHost);
      }

      if ($sDataBase != NULL)
      {
        \Config::set('database.connections.'.$sConnectionName.'.database', $sDataBase);
      }

      if ($sUser != NULL)
      {
        \Config::set('database.connections.'.$sConnectionName.'.username', $sUser);
      }

      if ($sPassword != NULL)
      {
        \Config::set('database.connections.'.$sConnectionName.'.password', $sPassword);
      }

      if ($bDefault)
      {
          \Config::set('database.default', $sConnectionName);
      }

      \DB::reconnect($sConnectionName);
  }

}
