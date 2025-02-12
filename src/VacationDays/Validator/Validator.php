<?php

declare(strict_types=1);

namespace VacationDays\Validator;

use VacationDays\Exception\ValidationFailedException;

class Validator
{
    private const INPUT_LENGTH = 1;

    private const NUMBER_OF_PREVIOUS_YEAR = 55;

    private const NUMBER_OF_NEXT_YEAR = 10;

    /**
     * @throws ValidationFailedException
     */
    public static function validate(array $givenYear): void
    {
        $compositeValidator = new CompositeValidator();
        $compositeValidator->addValidator(new ArrayLengthValidator($givenYear, self::INPUT_LENGTH))
            ->addValidator(new YearValidator($givenYear[0], self::NUMBER_OF_PREVIOUS_YEAR, self::NUMBER_OF_NEXT_YEAR));

        if ($compositeValidator->validate() === false) {
            throw new ValidationFailedException($compositeValidator->getErrors());
        }
    }
}
