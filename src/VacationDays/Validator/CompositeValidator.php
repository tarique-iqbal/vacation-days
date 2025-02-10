<?php

declare(strict_types=1);

namespace VacationDays\Validator;

final class CompositeValidator implements ValidatorInterface
{
    private array $validators = [];

    private array $errors = [];

    public function addValidator(ValidatorInterface $validator): static
    {
        $this->validators[] = $validator;

        return $this;
    }

    public function validate(array $context = []): bool
    {
        $isValid = true;

        foreach ($this->validators as $validator) {
            if ($validator->validate($context) === false) {
                $this->errors = array_merge($this->errors, $validator->getErrors());

                $isValid = false;
            }
        }

        return $isValid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
