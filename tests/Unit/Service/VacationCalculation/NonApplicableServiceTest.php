<?php

declare(strict_types=1);

namespace Tests\Unit\Service\VacationCalculation;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use VacationDays\Entity\Employee;
use VacationDays\Service\VacationCalculation\NonApplicableService;

class NonApplicableServiceTest extends TestCase
{
    public static function calculateDataProvider(): array
    {
        return [
            [
                [
                    "name" => "Tobias Graml",
                    "dateOfBirth" => "30.12.1991",
                    "contractStartDate" => "01.01.2023",
                    "isSpecialContract" => "no"
                ], 2021, 26, 0
            ],
            [
                [
                    "name" => "Farnaz Moayyedian",
                    "dateOfBirth" => "17.06.1992",
                    "contractStartDate" => "01.07.2024",
                    "isSpecialContract" => "yes"
                ], 2022, 27, 0
            ],
        ];
    }

    #[DataProvider('calculateDataProvider')]
    public function testCalculate(
        array $employeeData,
        int $givenYear,
        int $YearlyVacationDays,
        float $expectedVacationDays
    ): void {
        $employee = new Employee();
        $employee->setName($employeeData['name']);
        $employee->setDateOfBirth(
            DateTimeImmutable::createFromFormat('d.m.Y', $employeeData['dateOfBirth'])
        );
        $employee->setContractStartDate(
            DateTimeImmutable::createFromFormat('d.m.Y', $employeeData['contractStartDate'])
        );
        $employee->setIsSpecialContract($employeeData['isSpecialContract'] === 'yes');

        $nonApplicableService = new NonApplicableService();
        $yearlyVacationDays = $nonApplicableService->calculate($employee, $givenYear, $YearlyVacationDays);

        $this->assertSame($expectedVacationDays, $yearlyVacationDays);
    }
}
