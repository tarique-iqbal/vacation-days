<?php

declare(strict_types=1);

namespace VacationDays\Validator;

use DateInterval;
use DateTime;

final class YearValidator extends BaseValidator
{
    private const MESSAGE = 'Year must be in between %s and %s.';

    public function __construct(
        private readonly mixed $value,
        private readonly int $numberOfPreviousYear,
        private readonly int $numberOfNextYear,
    ) {
    }

    public function validate(array $context = []): bool
    {
        $minYear = (new DateTime())
            ->sub(new DateInterval('P' . $this->numberOfPreviousYear . 'Y'))
            ->format('Y');
        $maxYear = (new DateTime())
            ->add(new DateInterval('P' . $this->numberOfNextYear . 'Y'))
            ->format('Y');

        if (!preg_match('/^[0-9]+$/', $this->value)) {
            $this->addError('Year can contain numeric value [0-9] only.');

            return false;
        } elseif (($minYear <= $this->value && $maxYear >= $this->value) === false) {
            $this->addError(
                sprintf($this->message ?? self::MESSAGE, $minYear, $maxYear)
            );

            return false;
        }

        return true;
    }
}
