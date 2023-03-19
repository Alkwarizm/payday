<?php

use App\Models\Department;

use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;


it('should update a department', function (string $name, string $description) {
    $department = Department::factory([
        'name' => 'Development'
    ])->create();

    putJson(route('department.update', compact('department')), [
        'name' => $name,
        'description' => $description
    ])->assertNoContent();

    expect(Department::find($department->id))
        ->name->toBe($name)
        ->description->toBe($description);

})->with([
    ['name' => 'Development', 'description' => 'Updated Description'],
    ['name' => 'Development New', 'description' => 'Updated Description']
]);
