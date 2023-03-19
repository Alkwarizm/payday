<?php

namespace App\Http\Resources;

use App\ValueObjects\Amount;
use App\ValueObjects\Money;
use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class EmployeeResource extends JsonApiResource
{
    public $attributes = [
        ''
    ];

    public function toId(Request $request): string
    {
        return $this->uuid;
    }

    public function toAttributes(Request $request): array
    {
        return [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'job_title' => $this->job_title,
            'payment' => [
                'type' => $this->payment_type->type(),
                'amount' => Amount::from($this->payment_type->amount())->toArray()
            ],
        ];
    }
}
