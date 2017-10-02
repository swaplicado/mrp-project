<?php namespace App\SWMS;

use Illuminate\Database\Eloquent\Model;

class SItem extends Model {

  protected $connection = 'mrp';
  protected $primaryKey = 'id_item';
  protected $table = "wms_item_families";

  protected $fillable = [
                          'code',
                          'name',
                          'base_name',
                          'presentation',
                          'length',
                          'surface',
                          'volume',
                          'mass',
                          'pallet_qty',
                          'is_lot',
                          'is_bulk',
                          'is_deleted',
                          'gender_id',
                          'unit_id',
                        ];

  public function gender()
  {
    return $this->belongsTo('App\SWMS\SItemGender');
  }

  public function unit()
  {
    return $this->belongsTo('App\SWMS\SUnit');
  }

}
