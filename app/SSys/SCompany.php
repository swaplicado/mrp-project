<?php namespace App\SSys;

use Illuminate\Database\Eloquent\Model;

class SCompany extends Model {

    protected $primaryKey = 'id_company';
    protected $table = "sys_companies";
    protected $fillable = ['id_company', 'name', 'database_name', 'host', 'port', 'database_user', 'password', 'default_schema'];

    public function userCompany()
    {
    	return $this->hasMany('App\SSys\SUserCompany');
    }

    public function coUsPermission()
    {
      return $this->hasMany('App\SSys\SCoUsPermission');
    }

    public function scopeSearch($query, $name, $iFilter)
    {
        switch ($iFilter) {
          case \Config::get('scsys.FILTER.ACTIVES'):
            return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.ACTIVE'))
                        ->where('name', 'LIKE', "%".$name."%");
            break;

          case \Config::get('scsys.FILTER.DELETED'):
            return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.DEL'))
                          ->where('name', 'LIKE', "%".$name."%");
            break;

          case \Config::get('scsys.FILTER.ALL'):
            return $query->where('name', 'LIKE', "%".$name."%");
            break;

          default:
            return $query->where('name', 'LIKE', "%".$name."%");
            break;
        }
    }
}
