<?php

declare(strict_types=1);

namespace Tests\Unit\Validator;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use VacationDays\Validator\YearValidator;

class YearValidatorTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public static function yearProvider(): array
    {
        return [
            ['', false],
            ['@;<?Invalid#Character', false],
            [
                (new \DateTime())
                    ->sub(new \DateInterval('P11Y'))
                    ->format('Y'),
                false
            ],
            [
                (new \DateTime())
                    ->add(new \DateInterval('P11Y'))
                    ->format('Y'),
                false
            ],
            [(new \DateTime())->format('Y'), true],
        ];
    }

    #[DataProvider('yearProvider')]
    public function testValidate(string $year, bool $expectedStatus): void
    {
        $yearValidator = new YearValidator($year, 10, 10);
        $status = $yearValidator->validate();

        $this->assertSame($expectedStatus, $status);
    }
}
