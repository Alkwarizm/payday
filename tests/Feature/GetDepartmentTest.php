<?php

use App\Models\Department;

it('retrieves all departments', function () {

    Department::factory(5)->create();

    $data = $this->get(route('departments.index'))
        ->assertSuccessful()
        ->json('data');

    expect($data)
        ->toHaveCount(5);
});


it('retrieves a single department', function () {
    $department = Department::factory([
        'name' => 'Human Resource',
        'description' => 'The human resource department'
    ])->create();

    $data = $this->get(route('departments.show', $department))
            ->assertSuccessful()
            ->json('data');

    expect($data)
        ->attributes->name->toBe($department->name)
        ->attributes->description->toBe($department->description);
});
