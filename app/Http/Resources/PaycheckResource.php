<?php

namespace App\Http\Resources;

use App\ValueObjects\Amount;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use TiMacDonald\JsonApi\JsonApiResource;

class PaycheckResource extends JsonApiResource
{
    protected function toAttributes(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'net_amount' => Amount::from($this->net_amount)->toArray(),
            'paid_at' => $this->paid_at->format('Y-m-d')
        ];
    }

    #[ArrayShape(['employee' => "\Closure"])]
    protected function toRelationships(Request $request): array
    {
        return [
            'employee' => fn() => new EmployeeResource($this->employee)
        ];
    }
}
