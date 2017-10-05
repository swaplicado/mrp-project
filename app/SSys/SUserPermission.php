<?php namespace App\SSYS;

use Illuminate\Database\Eloquent\Model;

class SUserPermission extends Model
{
  protected $connection = 'ssystem';
  protected $primaryKey = 'id_usr_per';
  protected $table = "sys_user_permissions";
  public $timestamps = false;
  protected $fillable = ['id_usr_per','user_id','permission_id','privilege_id'];

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function privilege()
  {
      return $this->belongsTo('App\SSYS\SPrivilege');
  }

  public function permission()
  {
      return $this->belongsTo('App\SSYS\SPermission');
  }

  public function scopeSearch($query, $permission_id, $user_id)
  {
      return $query->where('permission_id', '=', "$permission_id")->where('user_id', '=', "$user_id");
  }
}
