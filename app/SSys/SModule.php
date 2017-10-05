<?php namespace App\SSYS;

use Illuminate\Database\Eloquent\Model;

class SModule extends Model
{
  protected $connection = 'ssystem';
  protected $primaryKey = 'id_module';
  protected $table = "syss_modules";
  protected $fillable = ['id_module','name'];

  public function companyModule()
  {
      return $this->hasMany('App\SSYS\SCompanyModule');
  }

  public function permission()
  {
      return $this->hasMany('App\SSYS\SPermission');
  }
}
