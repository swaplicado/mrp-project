<?php namespace App\SSYS;

use Illuminate\Database\Eloquent\Model;

class SUserCompany extends Model
{
  protected $connection = 'ssystem';
  protected $primaryKey = 'id_usr_comp';
  protected $table = "sys_user_companies";
  protected $fillable = ['id_usr_comp','user_id','company_id'];

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function company()
  {
      return $this->belongsTo('App\SSYS\SCompany', 'company_id');
  }

  public function scopeSearch($query, $iFilter)
    {
      switch ($iFilter) {
        case \Config::get('scsys.FILTER.ALL'):
          return $query;
          break;

        default:
          return $query;
          break;
      }
  }
}
