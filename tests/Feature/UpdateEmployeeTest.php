<?php

use App\Enums\PaymentTypes;
use App\Models\Department;
use App\Models\Employee;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

it('should update an employee', function (string $fullName, string $email, string $jobTitle, string $paymentType, ?int $salary, ?int $hourlyRate) {
    $employee = Employee::factory([
        'full_name' => 'Jarvis Neon',
        'email' => 'javis@example.com',
        'job_title' => 'Software Developer',
        'payment_type' => PaymentTypes::SALARY,
        'salary' => 55000 * 100,
        'department_id' => Department::factory()->create()->id
    ])->create();

    putJson(route('employees.update', compact('employee')), [
        'full_name' => $fullName,
        'email' => $email,
        'job_title' => $jobTitle,
        'payment_type' => $paymentType,
        'salary' => $salary,
        'hourly_rate' => $hourlyRate,
        'department_id' => Department::factory()->create()->uuid
    ])->assertNoContent();

    expect(Employee::find($employee->id))
        ->full_name->toBe($fullName)
        ->email->toBe($email)
        ->job_title->toBe($jobTitle)
        ->payment_type->type()->toBe($paymentType)
        ->salary->toBe($salary)
        ->hourly_rate->toBe($hourlyRate);
})->with([
    ['full_name' => 'Jarvis S. Marvin', 'email' => 'jarvis@example.com', 'job_title' => 'Superstar', 'payment_type' => PaymentTypes::SALARY, 'salary' => 25000 * 100, 'hourly_rate' => 0],
    ['full_name' => 'Michael Jordan', 'email' => 'jordan@example.com', 'job_title' => 'BasketBall Player', 'payment_type' => PaymentTypes::HOURLY_RATE, 'salary' => 0, 'hourly_rate' => 150 * 100],
]);
