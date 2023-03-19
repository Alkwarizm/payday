<?php
namespace App\DataTransferObjects;

class DepartmentData
{
    public function __construct(
        public string $name,
        public ?string $description
    )
    {}
}
