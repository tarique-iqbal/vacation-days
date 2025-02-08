<?php

declare(strict_types=1);

namespace VacationDays\Service\VacationCalculation;

use VacationDays\Entity\Employee;

interface CalculationServiceInterface
{
    public function setSuccessor(CalculationServiceInterface $calculator): CalculationServiceInterface;

    public function calculate(Employee $employee, int $givenYear, int $yearlyVacationDays): ?float;
}
