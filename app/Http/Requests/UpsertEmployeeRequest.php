<?php

namespace App\Http\Requests;

use App\Enums\PaymentTypes;
use App\Models\Department;
use App\Models\Employee;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertEmployeeRequest extends FormRequest
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

    public function getDepartment(): Department
    {
        return Department::whereUuid($this->department_id)->firstOrFail();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [Rule::when(!is_null($this->employee), [
                'required', 'email', Rule::unique(Employee::class, 'email')->ignore($this->employee), 'max:100'
            ], [
                'required', 'email', 'unique:employees', 'max:100'
            ])],
            'department_id' => ['required', 'string', 'exists:departments,uuid'],
            'job_title' => ['required', 'string'],
            'payment_type' => ['required', 'string', new EnumValue(PaymentTypes::class)],
            'salary' => [
                Rule::when($this->payment_type === PaymentTypes::SALARY, [
                    'required', 'integer', 'min:10'
                ], [
                    'nullable', 'exclude'
                ])
            ],
            'hourly_rate' => [
                Rule::when($this->payment_type === PaymentTypes::HOURLY_RATE,[
                    'required', 'integer', 'min:10'
                ], [
                    'nullable', 'exclude'
                ])
            ],
        ];
    }
}
