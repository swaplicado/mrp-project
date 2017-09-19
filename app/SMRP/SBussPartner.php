<?php namespace App\SMRP;

use Illuminate\Database\Eloquent\Model;

class SBussPartner extends Model {

  protected $connection = 'mrp';
  protected $primaryKey = 'id_bp';
  protected $table = "mrp_buss_partners";

  protected $fillable = [
                          'id_bp',
                          'bp_name',
                          'last_name',
                          'first_name',
                          'id_fiscal',
                          'curp',
                          'web',
                          'siie_id',
                          'is_company',
                          'is_supplier',
                          'is_customer',
                          'is_creditor',
                          'is_debtor',
                          'is_bank',
                          'is_employee',
                          'is_agt_sales',
                          'is_partner',
                          'is_deleted',
                        ];

  public function userCreation()
  {
    return $this->belongsTo('App\User', 'created_by_id');
  }

  public function userUpdate()
  {
    return $this->belongsTo('App\User', 'updated_by_id');
  }

  public function scopeSearch($query, $bpName, $iFilter, $iFilterBp)
  {
      $bAtt = true;
      $sAtt = '';

      switch ($iFilterBp) {
        case \Config::get('scmrp.ATT.ALL'):
          $bAtt = false;
          break;
        case \Config::get('scmrp.ATT.IS_COMP'):
          $sAtt = 'is_company';
          break;
        case \Config::get('scmrp.ATT.IS_SUPP'):
          $sAtt = 'is_supplier';
          break;
        case \Config::get('scmrp.ATT.IS_CUST'):
          $sAtt = 'is_customer';
          break;
        case \Config::get('scmrp.ATT.IS_CRED'):
          $sAtt = 'is_creditor';
          break;
        case \Config::get('scmrp.ATT.IS_DEBT'):
          $sAtt = 'is_debtor';
          break;
        case \Config::get('scmrp.ATT.IS_BANK'):
          $sAtt = 'is_bank';
          break;
        case \Config::get('scmrp.ATT.IS_EMPL'):
          $sAtt = 'is_employee';
          break;
        case \Config::get('scmrp.ATT.IS_AGTS'):
          $sAtt = 'is_agt_sales';
          break;
        case \Config::get('scmrp.ATT.IS_PART'):
          $sAtt = 'is_partner';
          break;
        default:
          $bAtt = false;
          break;
      }

      switch ($iFilter) {
        case \Config::get('scsys.FILTER.ACTIVES'):
          if ($bAtt)
          {
            return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.ACTIVE'))
                        ->where($sAtt, '=',  1)
                        ->where('bp_name', 'LIKE', "%".$bpName."%");
          }
          else
          {
            return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.ACTIVE'))
                        ->where('bp_name', 'LIKE', "%".$bpName."%");
          }
          break;

        case \Config::get('scsys.FILTER.DELETED'):
          if ($bAtt)
          {
            return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.DEL'))
                          ->where($sAtt, '=', 1)
                          ->where('bp_name', 'LIKE', "%".$bpName."%");
          }
          else
          {
            return $query->where('is_deleted', '=', "".\Config::get('scsys.STATUS.DEL'))
                          ->where('bp_name', 'LIKE', "%".$bpName."%");
          }
          break;

        case \Config::get('scsys.FILTER.ALL'):
          if ($bAtt)
          {
            return $query->where('bp_name', 'LIKE', "%".$bpName."%")
                          ->where($sAtt, '=', 1);
          }
          else
          {
            return $query->where('bp_name', 'LIKE', "%".$bpName."%");
          }
          break;

        default:
          if ($bAtt)
          {
            return $query->where('bp_name', 'LIKE', "%".$bpName."%")
                          ->where($sAtt, '=', 1);
          }
          else
          {
            return $query->where('bp_name', 'LIKE', "%".$bpName."%");
          }
          break;
      }
  }

}
