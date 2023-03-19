<?php

use App\Models\Department;
use function Pest\Laravel\postJson;


it('should create a department', function () {
    $department = postJson(route('department.store'), [
        'name' => 'Development',
        'description' => 'Awesome developers across the board!',
    ])->json('data');

    expect($department)
        ->attributes->name->toBe('Development')
        ->attributes->description->toBe('Awesome developers across the board!');
});

 it('should return 422 if name is invalid', function (?string $name) {
     $department = Department::factory([
         'name' => 'Development'
     ])->create();

     postJson(route('department.store'), [
         'name' => $name,
         'description' => 'description'
     ])->assertInvalid(['name']);

 })->with([
     '',
     null,
     'Development'
 ]);
