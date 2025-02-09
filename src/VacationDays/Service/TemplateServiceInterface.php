<?php

declare(strict_types=1);

namespace VacationDays\Service;

use VacationDays\Exception\FileNotFoundException;

interface TemplateServiceInterface
{
    /**
     * @throws FileNotFoundException
     */
    public function render(string $file, array $data): void;
}
