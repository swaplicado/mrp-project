<?php namespace App\SSYS;

use Illuminate\Database\Eloquent\Model;

class SCoUsPermission extends Model
{
  protected $connection = 'ssystem';
  protected $primaryKey = 'id_cup';
  protected $table = "sys_com_usr_prmssns";
  protected $fillable = ['id_cup'];

  public function permission()
  {
      return $this->belongsTo('App\SSYS\SPermission');
  }

  public function company()
  {
      return $this->belongsTo('App\SSYS\SCompany');
  }

  public function user()
  {
      return $this->belongsTo('App\User');
  }
}
