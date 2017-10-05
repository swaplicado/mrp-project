<?php namespace App\SWMS;

use Illuminate\Database\Eloquent\Model;

class SLocation extends Model {

  protected $connection = 'siie';
  protected $primaryKey = 'id_location';
  protected $table = 'wms_warehouse_locations';

  protected $fillable = [
                          'code',
                          'name',
                          'is_deleted',
                          'whs_id',
                        ];

  public function warehouse()
  {
    return $this->belongsTo('App\SWMS\SWarehouse', 'whs_id');
  }

  public function userCreation()
  {
    return $this->belongsTo('App\User', 'created_by_id');
  }

  public function userUpdate()
  {
    return $this->belongsTo('App\User', 'updated_by_id');
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
