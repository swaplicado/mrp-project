<?php namespace App\SWMS;

use Illuminate\Database\Eloquent\Model;

class SItemGender extends Model {

  protected $connection = 'mrp';
  protected $primaryKey = 'id_gender';
  protected $table = "wms_item_genders";

  protected $fillable = [
                          'name',
                          'is_length',
                          'is_length_var',
                          'is_surface',
                          'is_surface_var',
                          'is_volume',
                          'is_volume_var',
                          'is_mass',
                          'is_mass_var',
                          'is_lot',
                          'is_bulk',
                          'is_deleted',
                          'group_id',
                          'item_class_id',
                          'item_type_id',
                        ];

  public function group()
  {
    return $this->belongsTo('App\SWMS\SItemGroup');
  }

  public function class()
  {
    return $this->belongsTo('App\SWMS\SItemClass');
  }

  public function type()
  {
    return $this->belongsTo('App\SWMS\SItemType');
  }

}
