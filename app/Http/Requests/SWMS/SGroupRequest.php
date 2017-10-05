<?php namespace App\Http\Requests\SWMS;

use App\Http\Requests\Request;

class SGroupRequest extends Request
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
        return [
            'name' => 'required',
            'family_id' => 'required|exists:siie.wms_item_families,id_family',
        ];
    }
}
