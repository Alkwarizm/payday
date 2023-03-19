<?php

use App\Enums\PaymentTypes;
use App\Models\Department;
use App\Models\Employee;
use function Pest\Laravel\postJson;

it('should return 422 if email is invalid', function (?string $email) {
    Employee::factory([
        'email' => 'taken@example.com'
    ])->create();

    postJson(route('employees.store'), [
        'full_name' => 'Test Employer',
        'email' => $email,
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'BE Developer',
        'payment_type' => 'salary',
        'salary' => 75000 * 100,
    ])->assertInvalid(['email']);

})->with([
    'taken@example.com',
    'invalid',
    null,
    ''
]);

it('should return 422 if payment type is invalid', function () {
   postJson(route('employees.store'), [
       'full_name' => 'Test Employee',
       'email' => 'test@example.com',
       'department_id' => Department::factory()->create()->uuid,
       'job_title' => 'BE Developer',
       'payment_type' => 'invalid',
       'salary' => 75000 * 100
   ])->assertInvalid(['payment_type']);
});

it('should return 422 if salary is missing', function (string $paymentType, ?int $salary, ?int $hourlyRate) {
    postJson(route('employees.store'), [
        'full_name' => 'Test Employee',
        'email' => 'test@example.com',
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'BE Developer',
        'payment_type' => $paymentType,
        'salary' => $salary,
        'hourly_rate' => $hourlyRate
    ])->assertInvalid(['salary']);

})->with([
    ['payment_type' => PaymentTypes::SALARY, 'salary' => null, 'hourly_rate' => 30 * 100],
    ['payment_type' => PaymentTypes::SALARY, 'salary' => 0, 'hourly_rate' => null],
]);


it('should return 422 is hourly rate is missing', function (string $paymentType, ?int $salary, ?int $hourlyRate) {
    postJson(route('employees.store'), [
        'full_name' => 'Test Employee',
        'email' => 'test@example.com',
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'BE Developer',
        'payment_type' => $paymentType,
        'salary' => $salary,
        'hourly_rate' => $hourlyRate
    ])->assertInvalid(['hourly_rate']);
})->with([
    ['payment_type' => PaymentTypes::HOURLY_RATE, 'salary' => 75000 * 100, 'hourly_rate' => null],
    ['payment_type' => PaymentTypes::HOURLY_RATE, 'salary' => null, 'hourly_rate' => 0],
]);


it('should store an employee with payment type salary', function () {
    $employee = postJson(route('employees.store'), [
        'full_name' => 'Test Employee',
        'email' => 'test@example.com',
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'BE Developer',
        'payment_type' => PaymentTypes::SALARY,
        'salary' => 75000 * 100,
    ])->json('data');

    expect($employee)
        ->attributes->full_name->toBe('Test Employee')
        ->attributes->email->toBe('test@example.com')
        ->attributes->job_title->toBe('BE Developer')
        ->attributes->payment->type->toBe(PaymentTypes::SALARY)
        ->attributes->payment->amount->cents->toBe(75000 * 100)
        ->attributes->payment->amount->dollars->toBe('$75,000.00');
});


it('should store an employee with payment type hourly rate', function () {
    $employee = postJson(route('employees.store'), [
        'full_name' => 'Test Employee',
        'email' => 'test@example.com',
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'BE Developer',
        'payment_type' => PaymentTypes::HOURLY_RATE,
        'hourly_rate' => 30 * 100,
    ])->json('data');

    expect($employee)
        ->attributes->full_name->toBe('Test Employee')
        ->attributes->email->toBe('test@example.com')
        ->attributes->job_title->toBe('BE Developer')
        ->attributes->payment->type->toBe(PaymentTypes::HOURLY_RATE)
        ->attributes->payment->amount->cents->toBe(30 * 100)
        ->attributes->payment->amount->dollars->toBe('$30.00');
});
