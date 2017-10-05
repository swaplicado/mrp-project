<?php namespace App\SWMS;

use Illuminate\Database\Eloquent\Model;

class SItemType extends Model {

  protected $connection = 'siie';
  protected $primaryKey = 'id_itm_type';
  protected $table = "wmss_item_types";

  protected $fillable = [
                          'name',
                          'id_type',
                          'is_deleted',
                          'class_id',
                        ];

  public function genders()
  {
    return $this->belongsTo('App\SWMS\SItemClass');
  }

}
