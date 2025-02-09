<?php

declare(strict_types=1);

namespace VacationDays\Service;

use VacationDays\Exception\FileNotFoundException;

final class TemplateService implements TemplateServiceInterface
{
    /**
     * @throws FileNotFoundException
     */
    public function render(string $file, array $data): void
    {
        $file = $file . '.php';

        if (!file_exists($file)) {
            throw new FileNotFoundException(
                sprintf('Template file [%s] is missing.', $file)
            );
        }

        extract($data, EXTR_PREFIX_SAME, 'data');

        require($file);
    }
}
