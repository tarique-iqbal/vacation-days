<?php

declare(strict_types=1);

namespace Tests\Integration\Service;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use VacationDays\Container\ContainerFactory;
use VacationDays\Service\EmployeeVacationDaysServiceInterface;

class EmployeeVacationDaysServiceTest extends TestCase
{
    protected EmployeeVacationDaysServiceInterface $employeeVacationDaysService;

    protected function setUp(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';
        $container = (new ContainerFactory($config))->create();

        $this->employeeVacationDaysService = $container['EmployeeVacationDaysService'];
    }

    public static function calculateDataProvider(): array
    {
        return [
            [
                2017,
                [26, 26, 27, 0, 2.16],
            ],
            [
                2021,
                [27, 27, 28, 26, 26],
            ],
            [
                2023,
                [26, 26, 27, 27, 26],
            ],
        ];
    }

    #[DataProvider('calculateDataProvider')]
    public function testCalculate(int $givenYear, array $expectedVacationDays)
    {
        $employees = $this->employeeVacationDaysService->calculate($givenYear);

        $vacationDays = [];
        foreach ($employees as $employee) {
            $vacationDays[] = $employee->getVacationDaysOfGivenYear();
        }

        $this->assertEquals($expectedVacationDays, $vacationDays);
    }
}
