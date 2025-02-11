<?php

namespace VacationDays\Service;

use VacationDays\Entity\Employee;

interface EmployeeVacationDaysServiceInterface
{
    /**
     * @return Employee[]
     */
    public function calculate(int $year): array;
}
