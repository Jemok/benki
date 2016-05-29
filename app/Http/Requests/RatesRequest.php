<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RatesRequest extends Request
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
            'category_one' => 'required|numeric|min:1',
            'category_two' => 'required|numeric|min:1',
            'category_three' => 'required|numeric|min:1',
            'category_four' => 'required|numeric|min:1'
        ];
    }
}
