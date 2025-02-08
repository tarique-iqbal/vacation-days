<?php

declare(strict_types=1);

namespace VacationDays\Service\VacationCalculation;

use VacationDays\Entity\Employee;

final class NonApplicableService extends AbstractCalculationService
{
    private const VACATION_NON_APPLICABLE = 0;

    public function calculate(Employee $employee, int $givenYear, int $yearlyVacationDays): ?float
    {
        return self::VACATION_NON_APPLICABLE;
    }
}
