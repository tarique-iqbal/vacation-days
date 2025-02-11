<?php

declare(strict_types=1);

namespace VacationDays\Container;

use Pimple\Container;
use VacationDays\Repository\EmployeeRepository;
use VacationDays\Service\CliArgsService;
use VacationDays\Service\ConfigService;
use VacationDays\Service\TemplateService;
use VacationDays\Service\VacationCalculation\FollowingYearService;
use VacationDays\Service\VacationCalculation\JoiningYearService;
use VacationDays\Service\VacationCalculation\NonApplicableService;

class ContainerFactory
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
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

        $container['TemplateService'] = function () {
            return new TemplateService();
        };

        return $container;
    }
}
