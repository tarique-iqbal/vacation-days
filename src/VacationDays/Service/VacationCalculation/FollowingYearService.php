<?php

declare(strict_types=1);

namespace VacationDays\Service\VacationCalculation;

use DateTime;
use DateTimeInterface;
use VacationDays\Entity\Employee;

final class FollowingYearService extends AbstractCalculationService
{
    private const THIRTY_YEARS_OLD = 30;

    private const ADDITIONAL_VACATION_DAYS = 1;

    public function calculate(Employee $employee, int $givenYear, int $yearlyVacationDays): ?float
    {
        $joiningYear = intval($employee->getContractStartDate()->format('Y'));

        if ($joiningYear < $givenYear) {
            $calculatedVacationDays = $yearlyVacationDays;

            if (
                $this->isEmployeeAtLeastSpecificYearsOld($employee->getDateOfBirth()) &&
                $this->isEmploymentEachFifthYear($employee->getContractStartDate(), $givenYear)
            ) {
                $calculatedVacationDays += self::ADDITIONAL_VACATION_DAYS;
            }

            return $calculatedVacationDays;
        } else {
            return parent::calculate($employee, $givenYear, $yearlyVacationDays);
        }
    }

    private function isEmployeeAtLeastSpecificYearsOld(DateTimeInterface $dateOfBirth): bool
    {
        $firstDayOfNextYear = new DateTime('1st January Next Year');

        $difference = $dateOfBirth->diff($firstDayOfNextYear);

        if (self::THIRTY_YEARS_OLD <= $difference->y) {
            return true;
        }

        return false;
    }

    private function isEmploymentEachFifthYear(DateTimeInterface $contractStartDate, int $givenYear): bool
    {
        $nextYear = $givenYear + 1;
        $firstDayOfNextYear = DateTime::createFromFormat('d.m.Y', "01.01.$nextYear");
        $difference = $contractStartDate->diff($firstDayOfNextYear);

        if ($difference->y % 5 === 0 && $difference->m === 0 && $difference->d === 0) {
            return true;
        } elseif ($difference->y % 5 === 4 && ($difference->m >= 1 || $difference->d === 17)) {
            return true;
        }

        return false;
    }
}
