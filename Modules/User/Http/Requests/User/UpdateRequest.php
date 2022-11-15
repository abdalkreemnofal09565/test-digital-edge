<?php

namespace Modules\User\Http\Requests\User;

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
			'first_name' => 'required|string|max:191',
			'last_name' => 'required|string|max:191',
			'identifier' => 'required|email|max:255',
			'password' => 'required|string|max:255',
            'confirm_password' => 'required|string|max:255|same:password',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('user.update') ? true : false;    }
}
