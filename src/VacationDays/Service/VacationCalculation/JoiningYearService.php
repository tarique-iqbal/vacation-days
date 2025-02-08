<?php

declare(strict_types=1);

namespace VacationDays\Service\VacationCalculation;

use DateTime;
use VacationDays\Entity\Employee;

final class JoiningYearService extends AbstractCalculationService
{
    private const MONTHS_IN_A_YEAR = 12;

    public function calculate(Employee $employee, int $givenYear, int $yearlyVacationDays): ?float
    {
        $joiningYear = intval($employee->getContractStartDate()->format('Y'));

        if ($joiningYear === $givenYear) {
            $nextYear = $givenYear + 1;
            $firstDayOfNextYear = DateTime::createFromFormat('d.m.Y', "01.01.$nextYear");
            $difference = $employee->getContractStartDate()->diff($firstDayOfNextYear);
            $months = ($difference->d === 17) ?
                ($difference->y * self::MONTHS_IN_A_YEAR) + $difference->m + 0.5 :
                ($difference->y * self::MONTHS_IN_A_YEAR) + $difference->m;

            $calculatedVacationDays = (($yearlyVacationDays / self::MONTHS_IN_A_YEAR) * $months);

            return floor($calculatedVacationDays * 100) / 100;
        } else {
            return parent::calculate($employee, $givenYear, $yearlyVacationDays);
        }
    }
}
