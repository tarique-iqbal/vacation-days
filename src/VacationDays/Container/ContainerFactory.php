<?php

declare(strict_types=1);

namespace VacationDays\Container;

use Pimple\Container;
use VacationDays\Handler\ExceptionHandler;
use VacationDays\Repository\EmployeeRepository;
use VacationDays\Service\CliArgsService;
use VacationDays\Service\ConfigService;
use VacationDays\Service\EmployeeVacationDaysService;
use VacationDays\Service\TemplateService;
use VacationDays\Service\VacationCalculation\FollowingYearService;
use VacationDays\Service\VacationCalculation\JoiningYearService;
use VacationDays\Service\VacationCalculation\NonApplicableService;
use VacationDays\VacationDaysApplication;

final readonly class ContainerFactory
{
    public function __construct(private array $config)
    {
    }

    public function create(): Container
    {
        $container = new Container();

        $container['ConfigService'] = function () {
            return new ConfigService($this->config);
        };

        $container['CliArgsService'] = function () {
            return new CliArgsService();
        };

        $container['EmployeeRepository'] = function (Container $c) {
            return new EmployeeRepository(
                $c['ConfigService']->getEmployeeDataSourceFile()
            );
        };

        $container['JoiningYearService'] = function () {
            return new JoiningYearService();
        };

        $container['FollowingYearService'] = function () {
            return new FollowingYearService();
        };

        $container['NonApplicableService'] = function () {
            return new NonApplicableService();
        };

        $container['EmployeeVacationDaysService'] = function (Container $c) {
            return new EmployeeVacationDaysService(
                $c['EmployeeRepository'],
                $c['JoiningYearService'],
                $c['FollowingYearService'],
                $c['NonApplicableService'],
            );
        };

        $container['TemplateService'] = function () {
            return new TemplateService();
        };

        $container['VacationDaysApplication'] = function (Container $c) {
            return new VacationDaysApplication(
                $c['CliArgsService'],
                $c['EmployeeVacationDaysService'],
                $c['TemplateService'],
            );
        };

        $container['ExceptionHandler'] = function (Container $c) {
            return new ExceptionHandler(
                $c['ConfigService'],
            );
        };

        return $container;
    }
}
