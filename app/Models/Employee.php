<?php

namespace App\Models;

use App\Enums\PaymentTypes;
use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory, HasUuid;

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

    public function paymentType(): Attribute
    {
        return Attribute::make(
            get: fn($value) => PaymentTypes::fromValue($value)
                ->makePaymentType($this)
        );
    }

    public function salary(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (int) $value
        );
    }

    public function hourlyRate(): Attribute
    {
        return Attribute::make(
          get: fn($value) => (int) $value
        );
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(
            related: Department::class
        );
    }

    public function paychecks(): HasMany
    {
        return $this->hasMany(
          related: Paycheck::class
        );
    }

    public function timelogs(): HasMany
    {
        return $this->hasMany(
            related: Timelog::class
        );
    }
}
