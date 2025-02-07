<?php

declare(strict_types=1);

namespace VacationDays\Repository;

use VacationDays\Entity\Employee;

interface EmployeeRepositoryInterface
{
    /**
     * @return Employee[]
     */
    public function findAll(): array;
}
