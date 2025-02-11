<?php

declare(strict_types=1);

namespace VacationDays;

use VacationDays\Exception\FileNotFoundException;
use VacationDays\Exception\ValidationFailedException;
use VacationDays\Service\CliArgsServiceInterface;
use VacationDays\Service\EmployeeVacationDaysServiceInterface;
use VacationDays\Service\TemplateServiceInterface;
use VacationDays\Validator\Validator;

final class VacationDaysApplication
{
    private CliArgsServiceInterface $cliArgsService;

    private EmployeeVacationDaysServiceInterface $employeeVacationDaysService;

    private TemplateServiceInterface $templateService;

    public function __construct(
        CliArgsServiceInterface $cliArgsService,
        EmployeeVacationDaysServiceInterface $employeeVacationDaysService,
        TemplateServiceInterface $templateService
    ) {
        $this->cliArgsService = $cliArgsService;
        $this->employeeVacationDaysService = $employeeVacationDaysService;
        $this->templateService = $templateService;
    }

    /**
     * @throws FileNotFoundException
     * @throws ValidationFailedException
     */
    public function calculate(): void
    {
        $year = $this->cliArgsService->getArgs();

        Validator::validate($year);

        $employees = $this->employeeVacationDaysService->calculate((int) $year[0]);

        $this->templateService->render(
            BASE_DIR . '/src/VacationDays/Template/vacation_days',
            ['employees' => $employees]
        );
    }
}
