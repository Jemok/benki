<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class DepositAccountRequest extends Request
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

            'amount' => 'required|numeric|min:1|max:'.\Auth::user()->current_account()->first()->account_amount
        ];
    }
}
