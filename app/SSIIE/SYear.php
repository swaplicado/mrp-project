<?php namespace App\SSIIE;

use Illuminate\Database\Eloquent\Model;

class SYear extends Model {

  protected $connection = 'siie';
  protected $primaryKey = 'id_year';
  protected $table = "siie_years";
  protected $fillable = ['id_year', 'is_closed'];

  public function months()
  {
    return $this->hasMany('App\SSIIE\SMonth', 'year_id', 'id_year');
  }

  public function userCreation()
  {
    return $this->belongsTo('App\User', 'created_by_id');
  }

  public function userUpdate()
  {
    return $this->belongsTo('App\User', 'updated_by_id');
  }

  public function scopeSearch($query, $id, $iFilter)
  {
      switch ($iFilter) {
        case \Config::get('scsys.FILTER.ACTIVES'):
          return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.ACTIVE'))
                      ->where('id_year', 'LIKE', "%".$id."%");
          break;

        case \Config::get('scsys.FILTER.DELETED'):
          return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.DEL'))
                        ->where('id_year', 'LIKE', "%".$id."%");
          break;

        case \Config::get('scsys.FILTER.ALL'):
          return $query->where('id_year', 'LIKE', "%".$id."%");
          break;

        default:
          return $query->where('id_year', 'LIKE', "%".$id."%");
          break;
      }
  }
}
