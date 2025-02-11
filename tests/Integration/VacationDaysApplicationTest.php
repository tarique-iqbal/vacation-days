<?php

declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use VacationDays\Container\ContainerFactory;
use VacationDays\Service\CliArgsServiceInterface;
use VacationDays\VacationDaysApplication;

class VacationDaysApplicationTest extends TestCase
{
    protected CliArgsServiceInterface $cliArgsService;

    protected VacationDaysApplication $vacationDaysApplication;

    protected function setUp(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';
        $container = (new ContainerFactory($config))->create();
        $container['CliArgsService'] = $this
            ->getMockBuilder(CliArgsServiceInterface::class)
            ->getMock();

        $this->cliArgsService = $container['CliArgsService'];
        $this->vacationDaysApplication = $container['VacationDaysApplication'];
    }

    public static function calculateDataProvider(): array
    {
        return [
            [
                ['2017'],
                'Hans Müller: 26' . PHP_EOL .
                'Angelika Fringe: 26' . PHP_EOL .
                'Peter Klever: 27' . PHP_EOL .
                'Marina Helter: Inapplicable' . PHP_EOL .
                'Sepp Meier: 2.16' . PHP_EOL
            ],
            [
                ['2020'],
                'Hans Müller: 27' . PHP_EOL .
                'Angelika Fringe: 27' . PHP_EOL .
                'Peter Klever: 28' . PHP_EOL .
                'Marina Helter: 26' . PHP_EOL .
                'Sepp Meier: 26' . PHP_EOL
            ],
            [
                ['2022'],
                'Hans Müller: 26' . PHP_EOL .
                'Angelika Fringe: 26' . PHP_EOL .
                'Peter Klever: 27' . PHP_EOL .
                'Marina Helter: 27' . PHP_EOL .
                'Sepp Meier: 26' . PHP_EOL
            ],
        ];
    }

    #[DataProvider('calculateDataProvider')]
    public function testCalculate(array $givenYear, string $expectedOutput)
    {
        $this->cliArgsService
            ->method('getArgs')
            ->willReturn($givenYear);

        $this->expectOutputString($expectedOutput);

        $this->vacationDaysApplication->calculate();
    }
}
