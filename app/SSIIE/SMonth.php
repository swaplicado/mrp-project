<?php namespace App\SSIIE;

use Illuminate\Database\Eloquent\Model;

class SMonth extends Model {

  protected $connection = 'siie';
  protected $primaryKey = 'id_y_month';
  protected $table = "siie_year_months";
  protected $fillable = ['id_month', 'is_closed', 'is_deleted', 'year_id', 'created_by_id', 'updated_by_id'];


    public function __construct($iMonth = 0, $iYearId = 0)
    {
        $attributes = array();
        $attributes['id_month'] = $iMonth;
        $attributes['is_closed'] = false;
        $attributes['is_deleted'] = false;
        $attributes['year_id'] = $iYearId;
        $attributes['created_by_id'] = \Auth::user()->id;
        $attributes['updated_by_id'] = \Auth::user()->id;

        parent::__construct($attributes);
    }

  public function year()
  {
    return $this->belongsTo('App\SSIIE\SYear');
  }

  public function userCreation()
  {
    return $this->belongsTo('App\User', 'created_by_id');
  }

  public function userUpdate()
  {
    return $this->belongsTo('App\User', 'updated_by_id');
  }

  public function scopeSearch($query, $iFilter, $iYearId)
  {
      switch ($iFilter) {
        case \Config::get('scsys.FILTER.ACTIVES'):
          return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.ACTIVE'))
                      ->where('year_id', '=', $iYearId);
          break;

        case \Config::get('scsys.FILTER.DELETED'):
          return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.DEL'))
                        ->where('year_id', '=', $iYearId);
          break;

        case \Config::get('scsys.FILTER.ALL'):
          return $query->where('year_id', '=', $iYearId);
          break;

        default:
          return $query->where('year_id', '=', $iYearId);
          break;
      }
  }
}
