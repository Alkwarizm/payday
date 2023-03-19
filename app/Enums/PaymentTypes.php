<?php declare(strict_types=1);

namespace App\Enums;

use App\Concerns\PaymentType;
use App\Models\Employee;
use App\ValueObjects\HourlyRate;
use App\ValueObjects\Salary;
use BenSampo\Enum\Enum;

/**
 * @method static static SALARY()
 * @method static static HOURLY_RATE()
 */
final class PaymentTypes extends Enum
{
    const SALARY = 'salary';
    const HOURLY_RATE = 'hourly_rate';

    public function makePaymentType(Employee $employee): PaymentType
    {
        return match ($this->value) {
          self::SALARY => new Salary($employee),
          self::HOURLY_RATE => new HourlyRate($employee)
        };
    }
}
