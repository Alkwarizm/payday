<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentEmployeeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaydayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::post('departments', [DepartmentController::class, 'store'])->name('department.store');
Route::get('departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');
Route::put('departments/{department}', [DepartmentController::class, 'update'])->name('department.update');
Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
Route::put('employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::get('departments/{department}/employees', [DepartmentEmployeeController::class, 'index'])->name('department-employees');
Route::post('payday', [PaydayController::class, 'store'])->name('payday.store');
