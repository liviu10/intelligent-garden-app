<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListOfEquipmentRequest extends FormRequest
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
            'equipment_id' => [
                'required',
                'string',
                'max:15',
                'unique:list_of_equipments',
                Rule::in(['PH_SENSOR', 'EC_SENSOR', 'LEVEL_SENSOR', 'PUMP_1', 'PUMP_2', 'PUMP_3']),
            ],
            'equipment_description' => 'required|max:255|regex:/^[A-Za-z]+$/',
            'equipment_notes'       => 'sometimes|string',
            'is_active'   => [
                'sometimes',
                function ($attribute, $value, $fail) {
                    if (!is_bool($value)) {
                        $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                    }
                    if (!is_bool($value)) {
                        $fail($attribute . ' must be a boolean.');
                    }
                }
            ],
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
            'equipment_id.required'          => 'The equipment ID field is required.',
            'equipment_id.string'            => 'The equipment ID must be a string.',
            'equipment_id.max'               => 'The equipment ID must not exceed :max characters.',
            'equipment_id.unique'            => 'The equipment ID is already taken.',
            'equipment_id.in'                => 'The equipment ID is invalid.',
            'equipment_description.required' => 'The equipment description field is required.',
            'equipment_description.max'      => 'The equipment description must not exceed :max characters.',
            'equipment_description.regex'    => 'The equipment description must contain only capitalized and lowercase letters with no special characters.',
            'equipment_notes.string'         => 'The equipment notes must be a string.',
            'equipment_is_active.boolean'    => 'The equipment active status must be a boolean value.',
        ];
    }
}
