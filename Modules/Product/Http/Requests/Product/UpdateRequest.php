<?php

namespace Modules\Product\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'image'       => 'image|mimes:png,jpg|max:191',
			'name'        => 'required|string|max:191',
			'description' => 'string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        return auth()->user()->can('product.update') ? true : false;
    }
}
