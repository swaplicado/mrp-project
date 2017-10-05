<?php namespace App\SWMS;

use Illuminate\Database\Eloquent\Model;

class SItemGroup extends Model {

  protected $connection = 'siie';
  protected $primaryKey = 'id_group';
  protected $table = "wms_item_groups";

  public static function getTable()
  {
    return $this->table;
  }

  protected $fillable = [
                          'name',
                          'is_deleted',
                          'family_id',
                        ];

  public function genders()
  {
    return $this->hasMany('App\SWMS\SItemGender');
  }

  public function family()
  {
    return $this->belongsTo('App\SWMS\SItemFamily');
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
