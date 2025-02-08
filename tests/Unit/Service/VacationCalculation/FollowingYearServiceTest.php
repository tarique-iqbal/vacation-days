<?php

declare(strict_types=1);

namespace Tests\Unit\Service\VacationCalculation;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use VacationDays\Entity\Employee;
use VacationDays\Service\VacationCalculation\FollowingYearService;

class FollowingYearServiceTest extends TestCase
{
    public static function calculateDataProvider(): array
    {
        return [
            [
                [
                    "name" => "Tobias Graml",
                    "dateOfBirth" => "30.12.1981",
                    "contractStartDate" => "01.01.2011",
                    "isSpecialContract" => "no"
                ], 2020, 26, 27
            ],
            [
                [
                    "name" => "Farnaz Moayyedian",
                    "dateOfBirth" => "17.06.1977",
                    "contractStartDate" => "01.07.2016",
                    "isSpecialContract" => "yes"
                ], 2020, 27, 28
            ],
            [
                [
                    "name" => "Brian Young",
                    "dateOfBirth" => "30.12.1973",
                    "contractStartDate" => "01.12.2011",
                    "isSpecialContract" => "no"
                ], 2020, 26, 27
            ],
            [
                [
                    "name" => "Peter Klever",
                    "dateOfBirth" => "30.11.1975",
                    "contractStartDate" => "15.12.2016",
                    "isSpecialContract" => "no"
                ], 2020, 26, 27
            ],
            [
                [
                    "name" => "Angelika Fringe",
                    "dateOfBirth" => "09.06.1976",
                    "contractStartDate" => "15.12.2017",
                    "isSpecialContract" => "no"
                ], 2020, 26, 26
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
        $employee->setIsSpecialContract('yes' === $employeeData['isSpecialContract']);

        $followingYearService = new FollowingYearService();
        $yearlyVacationDays = $followingYearService->calculate($employee, $givenYear, $YearlyVacationDays);

        $this->assertSame($expectedVacationDays, $yearlyVacationDays);
    }
}
