<?php

declare(strict_types=1);

namespace VacationDays;

use VacationDays\Exception\FileNotFoundException;
use VacationDays\Exception\ValidationFailedException;
use VacationDays\Service\CliArgsServiceInterface;
use VacationDays\Service\EmployeeVacationDaysServiceInterface;
use VacationDays\Service\TemplateServiceInterface;
use VacationDays\Validator\Validator;

final readonly class VacationDaysApplication
{
    public function __construct(
        private CliArgsServiceInterface $cliArgsService,
        private EmployeeVacationDaysServiceInterface $employeeVacationDaysService,
        private TemplateServiceInterface $templateService
    ) {
    }

    /**
     * @throws FileNotFoundException
     * @throws ValidationFailedException
     */
    public function calculate(): void
    {
        $givenYear = $this->cliArgsService->getArgs();

        Validator::validate($givenYear);

        $employees = $this->employeeVacationDaysService->calculate((int) $givenYear[0]);

        $this->templateService->render(
            BASE_DIR . '/src/VacationDays/Template/vacation_days',
            ['employees' => $employees]
        );
    }
}
