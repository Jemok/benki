<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class TransferToFixedSavingsRequest extends Request
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
            'amount' => 'required|numeric',
            'duration'    => 'required|numeric',
            'withdraw_date' => 'required|date|date_format:"Y-m-d"|after:' . Carbon::today()->toDateString()
        ];
    }
}
