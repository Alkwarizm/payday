<?php

namespace App\Http\Controllers;

use App\Actions\UpsertDepartmentAction;
use App\DataTransferObjects\DepartmentData;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    public function __construct(
        protected UpsertDepartmentAction $upsertDepartment
    )
    {
    }


    public function index(): AnonymousResourceCollection
    {
        return DepartmentResource::collection(Department::all());
    }

    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        $departmentData = new DepartmentData(...$request->validated());

        $department = $this->upsertDepartment->execute($departmentData, new Department());

        return DepartmentResource::make($department)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Department $department): DepartmentResource
    {
        return DepartmentResource::make($department);
    }

    public function update(UpdateDepartmentRequest $request, Department $department): Response
    {
        $departmentData = new DepartmentData(...$request->validated());

        $this->upsertDepartment->execute($departmentData, $department);

        return response()->noContent();
    }
}
