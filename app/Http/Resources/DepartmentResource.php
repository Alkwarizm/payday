<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class DepartmentResource extends JsonApiResource
{
    protected function toId(Request $request): string
    {
        return $this->uuid;
    }

    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description
        ];
    }

    public function toRelationships(Request $request): array
    {
        return [
            'employees' => fn() => EmployeeResource::collection($this->employees),
        ];
    }
//
    public function toLinks(Request $request): array
    {
        return [
            'self' => route('departments.show',['department' => $this->uuid])
        ];
    }
}
