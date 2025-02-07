<?php

declare(strict_types=1);

namespace VacationDays\Repository;

use DateTimeImmutable;
use VacationDays\Entity\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    private array $dataSource;

    public function __construct(string $employeeDataSourceFile)
    {
        $jsonString = file_get_contents($employeeDataSourceFile, true);
        $this->dataSource = json_decode($jsonString, true);
    }

    /**
     * @return Employee[]
     */
    public function findAll(): array
    {
        $employees = [];

        foreach ($this->dataSource['employees'] as $key => $employeeData) {
            $employee = new Employee();
            $employee->setName($employeeData['name']);
            $employee->setDateOfBirth(
                DateTimeImmutable::createFromFormat('d.m.Y', $employeeData['dateOfBirth'])
            );
            $employee->setContractStartDate(
                DateTimeImmutable::createFromFormat('d.m.Y', $employeeData['contractStartDate'])
            );
            $employee->setIsSpecialContract('yes' === $employeeData['isSpecialContract']);

            $employees[$key] = $employee;
        }

        return $employees;
    }
}
