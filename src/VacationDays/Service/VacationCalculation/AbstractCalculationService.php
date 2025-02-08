<?php

declare(strict_types=1);

namespace VacationDays\Service\VacationCalculation;

use VacationDays\Entity\Employee;

abstract class AbstractCalculationService implements CalculationServiceInterface
{
    private ?CalculationServiceInterface $successor;

    public function __construct()
    {
        $this->successor = null;
    }

    public function setSuccessor(CalculationServiceInterface $calculator): CalculationServiceInterface
    {
        $this->successor = $calculator;

        return $calculator;
    }

    public function calculate(Employee $employee, int $givenYear, int $yearlyVacationDays): ?float
    {
        return $this->successor?->calculate($employee, $givenYear, $yearlyVacationDays);
    }
}
