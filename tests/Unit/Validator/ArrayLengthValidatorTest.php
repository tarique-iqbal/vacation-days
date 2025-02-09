<?php

declare(strict_types=1);

namespace Tests\Unit\Validator;

use VacationDays\Validator\ArrayLengthValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ArrayLengthValidatorTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [
                [], 1, false
            ],
            [
                ['', ''], 1, false
            ],
            [
                ['2010', '2020'], 1, false
            ],
            [
                ['2022'], 1, true
            ]
        ];
    }

    #[DataProvider('dataProvider')]
    public function testValidate(array $array, int $inputLength, bool $expectedStatus): void
    {
        $arraySizeValidator = new ArrayLengthValidator($array, $inputLength);
        $status = $arraySizeValidator->validate();

        $this->assertSame($expectedStatus, $status);
    }
}
