<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddTransactionChargeRequest extends Request
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
            'transaction_type' => 'required|numeric',
            'transaction_name' => 'required',
            'transaction_category' => 'required|numeric',
            'charge'           => 'required|numeric'
        ];
    }
}
