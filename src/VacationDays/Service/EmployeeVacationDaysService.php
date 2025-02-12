<?php

declare(strict_types=1);

namespace VacationDays\Service;

use VacationDays\Entity\Employee;
use VacationDays\Repository\EmployeeRepositoryInterface;
use VacationDays\Service\VacationCalculation\CalculationServiceInterface;

final readonly class EmployeeVacationDaysService implements EmployeeVacationDaysServiceInterface
{
    private const ORDINARY_VACATION_DAYS = 26;

    private const SPECIAL_VACATION_DAYS = 27;

    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private CalculationServiceInterface $joiningYearService,
        private CalculationServiceInterface $followingYearService,
        private CalculationServiceInterface $nonApplicableService,
    ) {
    }

    /**
     * @return Employee[]
     */
    public function calculate(int $givenYear): array
    {
        $employees = $this->employeeRepository->findAll();

        $this->joiningYearService
            ->setSuccessor($this->followingYearService)
            ->setSuccessor($this->nonApplicableService);

        foreach ($employees as $employee) {
            $yearlyVacationDays = ($employee->getIsSpecialContract() === true) ?
                self::SPECIAL_VACATION_DAYS :
                self::ORDINARY_VACATION_DAYS;

            $givenYearVacationDays = $this->joiningYearService->calculate(
                $employee,
                $givenYear,
                $yearlyVacationDays
            );

            $employee->setVacationDaysOfGivenYear($givenYearVacationDays);
        }

        return $employees;
    }
}
