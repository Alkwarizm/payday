<?php

namespace App\Http\Controllers;

use App\Actions\UpsertEmployeeAction;
use App\DataTransferObjects\EmployeeData;
use App\Http\Requests\UpsertEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeeController extends Controller
{
    public function __construct(
        protected UpsertEmployeeAction $upsertEmployee
    )
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $employees = QueryBuilder::for(Employee::class)
                    ->allowedFilters(
                        ['full_name', 'job_title', 'email', 'department.name']
                    )->allowedIncludes(['department'])
                    ->get();

        return EmployeeResource::collection($employees);
    }

    public function store(UpsertEmployeeRequest $request): JsonResponse
    {
        $employee = $this->upsertEmployee->execute(
            new Employee(),
            EmployeeData::fromRequest($request)
        );

        return EmployeeResource::make($employee)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Employee $employee): EmployeeResource
    {
        return EmployeeResource::make($employee);
    }

    public function update(UpsertEmployeeRequest $request, Employee $employee): Response
    {
        $this->upsertEmployee->execute(
            $employee,
            EmployeeData::fromRequest($request)
        );

        return response()->noContent();
    }
}
