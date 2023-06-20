<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name'        => 'required|max:255|regex:/^[A-Za-z]+$/',
            'last_name'         => 'required|max:255|regex:/^[A-Za-z]+$/',
            'nickname'          => 'required|max:255|regex:/^[a-z0-9_]+$/',
            'email'             => 'required|max:255|unique:users',
            'password'          => 'required',
            'user_role_type_id' => 'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required'        => 'Field <:attribute> is required!',
            'first_name.max'             => 'Field <:attribute> must not exceed :max characters!',
            'first_name.regex'           => 'Field <:attribute> must contain only capitalize and lower letters with no special characters!',
            'last_name.required'         => 'Field <:attribute> is required!',
            'last_name.max'              => 'Field <:attribute> must not exceed :max characters!',
            'last_name.regex'            => 'Field <:attribute> must contain only capitalize and lower letters with no special characters!',
            'nickname.required'          => 'Field <:attribute> is required!',
            'nickname.max'               => 'Field <:attribute> must not exceed :max characters!',
            'nickname.regex'             => 'Field <:attribute> must contain only lower letters and numbers with no special characters!',
            'email.required'             => 'Field <:attribute> is required!',
            'email.max'                  => 'Field <:attribute> must not exceed :max characters!',
            'email.unique'               => 'Field <:attribute> must be a unique value!',
            'password.required'          => 'Field <:attribute> is required!',
            'user_role_type_id.required' => 'Field <:attribute> is required!',
        ];
    }
}
