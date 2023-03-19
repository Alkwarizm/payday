<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Department extends Model
{
    use HasFactory;
    use HasUuid;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'uuid'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function employees(): HasMany
    {
        return $this->hasMany(
            related: Employee::class
        );
    }

    public function paychecks(): HasManyThrough
    {
        return $this->hasManyThrough(
          related: Paycheck::class,
          through: Employee::class
        );
    }
}
