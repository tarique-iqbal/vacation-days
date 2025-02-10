<?php

declare(strict_types=1);

namespace VacationDays\Validator;

use VacationDays\Exception\ValidationFailedException;

class Validator
{
    private const INPUT_LENGTH = 1;

    private const NUMBER_OF_PREVIOUS_YEAR = 10;

    private const NUMBER_OF_NEXT_YEAR = 10;

    /**
     * @throws ValidationFailedException
     */
    public static function validate(array $year): void
    {
        $compositeValidator = new CompositeValidator();
        $compositeValidator->addValidator(new ArrayLengthValidator($year, self::INPUT_LENGTH))
            ->addValidator(new YearValidator($year[0], self::NUMBER_OF_PREVIOUS_YEAR, self::NUMBER_OF_NEXT_YEAR));

        if ($compositeValidator->validate() === false) {
            throw new ValidationFailedException($compositeValidator->getErrors());
        }
    }
}
