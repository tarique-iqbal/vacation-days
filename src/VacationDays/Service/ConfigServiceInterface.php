<?php

declare(strict_types=1);

namespace VacationDays\Service;

interface ConfigServiceInterface
{
    public function getEmployeeDataSourceFile(): string;

    public function getErrorLogFile(): string;
}
