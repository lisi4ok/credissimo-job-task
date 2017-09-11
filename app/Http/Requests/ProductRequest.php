<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class ProductRequest extends Request
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
        $rule['name'] = "required|max:255";
        $rule['sku'] = "required|max:255";
        $rule['description'] = "required";
        $rule ['price'] = "required|max:14|regex:/^-?\\d*(\\.\\d+)?$/";
        return $rule;
    }
}
