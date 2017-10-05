<?php namespace App\Http\Requests\SWMS;

use App\Http\Requests\Request;
use App\SWMS\SWarehouse;
use App\SWMS\SWhsType;
use App\SSIIE\SBranch;

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
            'code' => 'required|unique:siie.'.$whs->getTable(),
            'name' => 'required',
            'branch_id' => 'required|exists:siie.'.$branch->getTable().',id_branch',
            'whs_type_id_opt' => 'exists:siie.'.$whstype->getTable().',id_type',
        ];
    }
}
