<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use VacationDays\Service\CliArgsService;

class CliArgsServiceTest extends TestCase
{
    private const FILE = 'index.php';

    public static function addCliArgsDataProvider(): array
    {
        return [
            [
                [self::FILE], 0, []
            ],
            [
                [self::FILE, 'Value'], 1, ['Value']
            ],
            [
                [self::FILE, '2022', '2021'], 2, ['2022', '2021']
            ],
        ];
    }

    #[DataProvider('addCliArgsDataProvider')]
    public function testGetArgs(array $arguments, int $countExpected, array $resultExpected): void
    {
        $_SERVER['argv'] = $arguments;

        $cliArgsService = new CliArgsService();
        $result = $cliArgsService->getArgs();

        $this->assertSame($resultExpected, $result);
        $this->assertCount($countExpected, $result);
    }
}
