<?php


namespace App\DataTransferObjects;


use App\Http\Requests\UpsertEmployeeRequest;
use App\Models\Department;

class EmployeeData
{
    public function __construct(
        public string $fullName,
        public string $email,
        public Department $department,
        public string $jobTitle,
        public string $paymentType,
        public ?int $salary,
        public ?int $hourlyRate
    )
    {
    }

    public static function fromRequest(UpsertEmployeeRequest $request): self
    {
        return new static(
          fullName: $request->full_name,
          email: $request->email,
          department: $request->getDepartment(),
          jobTitle: $request->job_title,
          paymentType: $request->payment_type,
          salary: $request->salary,
          hourlyRate: $request->hourly_rate
        );
    }
}
