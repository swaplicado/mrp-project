<?php namespace App\SWMS;

use Illuminate\Database\Eloquent\Model;

class SItemClass extends Model {

  protected $connection = 'siie';
  protected $primaryKey = 'id_class';
  protected $table = "wmss_item_classes";

  public static function getTable()
  {
    return $this->table;
  }

  protected $fillable = [
                          'name',
                          'is_deleted',
                        ];

  public function types()
  {
    return $this->hasMany('App\SWMS\SItemType');
  }

}
