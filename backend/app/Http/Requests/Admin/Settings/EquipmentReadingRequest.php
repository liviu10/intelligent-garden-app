<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentReadingRequest extends FormRequest
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
            'list_of_equipment_id' => 'required',
            'equipment_value' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $arduinoId = request('list_of_equipment_id');
                    if ($arduinoId === 1 && ($value < 0.00 || $value > 14.00)) {
                        $fail($attribute . ' must be between 0.00 and 14.00 when list_of_equipment_id is 1.');
                    }
                    if ($arduinoId === 2 && ($value < 0.70 || $value > 1.20)) {
                        $fail($attribute . ' must be between 0.70 and 1.20 when list_of_equipment_id is 2.');
                    }
                    if ($arduinoId === 3 && !in_array($value, [0, 1, 2])) {
                        $fail($attribute . ' must be either 0, 1, or 2 when list_of_equipment_id is 3.');
                    }
                    if ($arduinoId >= 4 && $arduinoId <= 6 && !in_array($value, [0, 1])) {
                        $fail($attribute . ' must be either 0 or 1 when list_of_equipment_id is 4, 5, or 6.');
                    }
                },
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
            'list_of_equipment_id.required' => 'The Arduino list of equipment ID field is required.',
            'equipment_value.required'      => 'The equipment value field is required.',
            'equipment_value.numeric'       => 'The equipment value must be a numeric value.',
            'equipment_value.between'       => 'The equipment value must be between :min and :max when the Arduino list of equipment ID is :arduinoId.',
            'equipment_value.in'            => 'The equipment value must be one of the following: 0, 1, 2 when the Arduino list of equipment ID is :arduinoId.',
            'equipment_value.in'            => 'The equipment value must be either 0 or 1 when the Arduino list of equipment ID is 4, 5, or 6.',
        ];
    }
}
