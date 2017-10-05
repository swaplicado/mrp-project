<?php namespace App\SSYS;

use Illuminate\Database\Eloquent\Model;

class SUserType extends Model
{
  protected $connection = 'ssystem';
  protected $primaryKey = 'id_type';
  protected $table = "syss_user_types";
  protected $fillable = ['id_type','name'];

  public function user()
  {
      return $this->hasMany('App\User');
  }
}
