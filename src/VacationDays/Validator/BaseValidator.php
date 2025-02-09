<?php

declare(strict_types=1);

namespace VacationDays\Validator;

abstract class BaseValidator implements ValidatorInterface
{
    protected array $errors = [];

    protected string $message;

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    protected function addError(string $error): void
    {
        $this->errors[] = $error;
    }
}
