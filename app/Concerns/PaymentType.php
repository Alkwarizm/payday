<?php


namespace App\Concerns;


use App\Models\Employee;

abstract class PaymentType
{
    public function __construct(
        protected Employee $employee
    )
    {}

    abstract public function monthlyAmount(): int;

    abstract public function type(): string;

    abstract public function amount(): int;
}
