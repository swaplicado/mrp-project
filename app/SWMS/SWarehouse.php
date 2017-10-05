<?php namespace App\SWMS;

use Illuminate\Database\Eloquent\Model;

class SWarehouse extends Model {

  protected $connection = 'siie';
  protected $primaryKey = 'id_whs';
  protected $table = "wms_warehouses";

  public function getTable()
  {
    return $this->table;
  }

  protected $fillable = [
                          'code',
                          'name',
                          'is_deleted',
                          'branch_id',
                          'whs_type_id_opt',
                        ];

  public function whsType()
  {
    return $this->belongsTo('App\SWMS\SWhsType', 'whs_type_id_opt');
  }

  public function branch()
  {
    return $this->belongsTo('App\SSIIE\SBranch', 'branch_id');
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
