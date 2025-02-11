<?php

declare(strict_types=1);

namespace VacationDays\Service;

use VacationDays\Entity\Employee;
use VacationDays\Repository\EmployeeRepositoryInterface;
use VacationDays\Service\VacationCalculation\CalculationServiceInterface;

final class EmployeeVacationDaysService implements EmployeeVacationDaysServiceInterface
{
    private const ORDINARY_VACATION_DAYS = 26;

    private const SPECIAL_VACATION_DAYS = 27;

    private EmployeeRepositoryInterface $employeeRepository;

    private CalculationServiceInterface $joiningYearService;

    private CalculationServiceInterface $followingYearService;

    private CalculationServiceInterface $nonApplicableService;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        CalculationServiceInterface $joiningYearService,
        CalculationServiceInterface $followingYearService,
        CalculationServiceInterface $nonApplicableService,
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->joiningYearService = $joiningYearService;
        $this->followingYearService = $followingYearService;
        $this->nonApplicableService = $nonApplicableService;
    }

    /**
     * @return Employee[]
     */
    public function calculate(int $year): array
    {
        $employees = $this->employeeRepository->findAll();

        $this->joiningYearService
            ->setSuccessor($this->followingYearService)
            ->setSuccessor($this->nonApplicableService);

        foreach ($employees as $employee) {
            $yearlyVacationDays = ($employee->getIsSpecialContract() === true) ?
                self::SPECIAL_VACATION_DAYS :
                self::ORDINARY_VACATION_DAYS;

            $yearlyVacationDays = $this->joiningYearService->calculate(
                $employee,
                $year,
                $yearlyVacationDays
            );

            $employee->setVacationDaysOfGivenYear($yearlyVacationDays);
        }

        return $employees;
    }
}
