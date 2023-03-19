<?php


namespace App\ValueObjects;


use App\Concerns\PaymentType;
use App\Enums\PaymentTypes;
use App\Models\Employee;
use App\Models\Timelog;

class HourlyRate extends PaymentType
{
    public function __construct(Employee $employee)
    {
        throw_if(
          $employee->hourly_rate === null,
          new \RuntimeException("Hourly rate cannot be null")
        );

        parent::__construct($employee);
    }

    public function monthlyAmount(): int
    {
        $hoursWorked = Timelog::query()
                        ->whereBetween('stopped_at', [
                            now()->startOfMonth(),
                            now()->endOfMonth()
                        ])->sum('minutes') / 60
                        ;

        return round($hoursWorked) * $this->employee->hourly_rate;
    }

    public function type(): string
    {
        return PaymentTypes::HOURLY_RATE;
    }

    public function amount(): int
    {
        return $this->employee->hourly_rate;
    }
}
