<?php

declare(strict_types=1);

namespace VacationDays\Validator;

final class ArrayLengthValidator extends BaseValidator
{
    private const MESSAGE = 'Input length should be equal to %d.';

    public function __construct(
        private readonly mixed $value,
        private readonly int $inputLength,
    ) {
    }

    public function validate(array $context = []): ?bool
    {
        if (!is_array($this->value)) {
            return null;
        }

        if (count($this->value) !== $this->inputLength) {
            $this->addError(
                sprintf($this->message ?? self::MESSAGE, $this->inputLength)
            );

            return false;
        }

        return true;
    }
}
