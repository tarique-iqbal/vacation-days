<?php

declare(strict_types=1);

namespace VacationDays\Exception;

final class FileNotFoundException extends \Exception
{
    public function __construct(string $message = null, int $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
