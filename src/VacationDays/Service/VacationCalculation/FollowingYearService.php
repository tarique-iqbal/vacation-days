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
                $this->doesAgeCriteriaQualify($employee->getDateOfBirth(), $givenYear) &&
                $this->isEmploymentOnFifthYear($joiningYear, $givenYear)
            ) {
                $calculatedVacationDays += self::ADDITIONAL_VACATION_DAYS;
            }

            return $calculatedVacationDays;
        } else {
            return parent::calculate($employee, $givenYear, $yearlyVacationDays);
        }
    }

    private function doesAgeCriteriaQualify(DateTimeInterface $dateOfBirth, int $givenYear): bool
    {
        $lastDayOfGivenYear = DateTime::createFromFormat('d.m.Y', "31.12.$givenYear");
        $difference = $dateOfBirth->diff($lastDayOfGivenYear);

        if (self::THIRTY_YEARS_OLD <= $difference->y) {
            return true;
        }

        return false;
    }

    private function isEmploymentOnFifthYear(int $joiningYear, int $givenYear): bool
    {
        $employmentYears = $givenYear - $joiningYear;

        return $employmentYears % 5 === 0;
    }
}
