<?php namespace App\SSYS;

use Illuminate\Database\Eloquent\Model;

class SPermissionType extends Model {

    protected $connection = 'ssystem';
    protected $primaryKey = 'id_type';
    protected $table = "syss_permission_types";
    protected $fillable = ['id_type', 'name'];

    public function permissions()
    {
      return $this->hasMany('App\SSIIE\SPermission');
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
