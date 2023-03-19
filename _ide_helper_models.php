<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Paycheck> $paychecks
 * @property-read int|null $paychecks_count
 * @method static \Database\Factories\DepartmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUuid($value)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Employee
 *
 * @property int $id
 * @property string $uuid
 * @property int $department_id
 * @property string $full_name
 * @property string $email
 * @property string $job_title
 * @property string $payment_type
 * @property int|null $salary
 * @property int|null $hourly_rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Department|null $department
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Paycheck> $paychecks
 * @property-read int|null $paychecks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Timelog> $timelogs
 * @property-read int|null $timelogs_count
 * @method static \Database\Factories\EmployeeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereHourlyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUuid($value)
 */
	class Employee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Paycheck
 *
 * @property int $id
 * @property string $uuid
 * @property int $employee_id
 * @property int|null $net_amount
 * @property string|null $payed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $employee
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck query()
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck whereNetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck wherePayedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paycheck whereUuid($value)
 */
	class Paycheck extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Timelog
 *
 * @property int $id
 * @property string $uuid
 * @property int $employee_id
 * @property string $started_at
 * @property string $stopped_at
 * @property int $minutes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $employee
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog whereMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog whereStoppedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timelog whereUuid($value)
 */
	class Timelog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

