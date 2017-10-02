<?php namespace App\Http\Requests\SWMS;

use App\Http\Requests\Request;
use App\SWMS\SWarehouse;
use App\SWMS\SWhsType;
use App\SMRP\SBranch;

class SWhsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $whs = new SWarehouse();
      $branch = new SBranch();
      $whstype = new SWhsType();

        return [
            'code' => 'required|unique:mrp.'.$whs->getTable(),
            'name' => 'required',
            'branch_id' => 'required|exists:mrp.'.$branch->getTable().',id_branch',
            'whs_type_id_opt' => 'exists:mrp.'.$whstype->getTable().',id_type',
        ];
    }
}
