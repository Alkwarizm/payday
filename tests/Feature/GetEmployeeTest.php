<?php

use App\Models\Department;
use App\Models\Employee;
use App\ValueObjects\Money;
use function Pest\Laravel\getJson;

it('retrieves all employees', function () {
    $employees = Employee::factory(5)->create();

    $data = getJson(route('employees.index'))
        ->assertSuccessful()
        ->json('data');

    expect($data)
        ->toHaveCount($employees->count());
});

it('retrieves a single employees data', function () {
    /** @var Employee $employee */
    $employee = Employee::factory()->create();

    $data = getJson(route('employees.show', compact('employee')))
        ->assertSuccessful()
        ->json('data');

    expect($data)
        ->attributes->full_name->toBe($employee->full_name)
        ->attributes->email->toBe($employee->email)
        ->attributes->job_title->toBe($employee->job_title)
        ->attributes->payment->type->toBe($employee->payment_type->type())
        ->attributes->payment->amount->cents->toBe(Money::from($employee->payment_type->amount())->toCents())
        ->attributes->payment->amount->dollars->toBe(Money::from($employee->payment_type->amount())->toDollars());
});

it('should return all employees for a department', function () {
    $development = Department::factory(['name' => 'Development'])->create();
    $marketing = Department::factory(['name' => 'Marketing'])->create();

    $developers = Employee::factory(
        ['department_id' => $development->id]
    )->count(5)->create();

    $marketers = Employee::factory([
        'department_id' => $marketing->id
    ])->count(2)->create();

    $employees = getJson(route('department-employees', ['department' => $development]))
                ->json('data');

    $uuids = $developers->pluck('uuid')->map(fn(string $uuid) => $uuid);

    expect($employees)
        ->toHaveCount(5);

    expect($employees)
        ->each(fn($employee) => $employee->id->toBeIn($uuids));
});


it('should filter employees', function () {
    $development = Department::factory(['name' => 'Development'])->create();
    $marketing = Department::factory(['name' => 'Marketing'])->create();


    $developers = Employee::factory(
        ['department_id' => $development->id]
    )->count(4)->create();

    $developer = Employee::factory([
        'full_name' => 'Test John Doe',
        'department_id' => $development->id
    ])->create();

    $marketers = Employee::factory([
        'department_id' => $marketing->id
    ])->count(2)->create();

    $employees = getJson(route('department-employees', [
        'department' => $development,
        'filter' => [
                'full_name' => 'test',
            ]
        ]
    ))->json('data');

    expect($employees)
        ->toHaveCount(1);

    expect($employees[0])
        ->id->toBe((string) $developer->uuid);
});
