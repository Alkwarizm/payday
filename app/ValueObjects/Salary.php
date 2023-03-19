<?php


namespace App\ValueObjects;


use App\Concerns\PaymentType;
use App\Enums\PaymentTypes;
use App\Models\Employee;

class Salary extends PaymentType
{
    public function __construct(Employee $employee)
    {
        throw_if(
            condition: $employee->salary === null,
            exception: new \RuntimeException("Salary cannot be null")
        );

        parent::__construct($employee);
    }

    public function monthlyAmount(): int
    {
        return $this->employee->salary / 12;
    }

    public function type(): string
    {
        return PaymentTypes::SALARY;
    }

    public function amount(): int
    {
        return $this->employee->salary;
    }
}
