<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreLeaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'leave_type_id' => [
                'required',
                'exists:leave_types,id'
            ],

            'start_date' => [
                'required',
                'date' , 
                'after_or_equal:today'
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],

            'reason' => [
                'required',
                'string',
                'max:1000'
            ]
        ];
    }

    #[Override]
    public function messages()
    {
         return [
            'leave_type_id.required' =>
                'Please select a leave type.',

            'leave_type_id.exists' =>
                'Invalid leave type selected.',

            'end_date.after_or_equal' =>
                'End date must be after start date.'
        ];
    }
}
