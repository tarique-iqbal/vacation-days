<?php

declare(strict_types=1);

namespace Tests\Integration\Container;

use PHPUnit\Framework\TestCase;
use Pimple\Container;
use VacationDays\Container\ContainerFactory;
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

class ContainerFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';

        $container = (new ContainerFactory($config))->create();

        $this->assertInstanceOf(Container::class, $container);
        $this->assertInstanceOf(ConfigService::class, $container['ConfigService']);
        $this->assertInstanceOf(CliArgsService::class, $container['CliArgsService']);
        $this->assertInstanceOf(EmployeeRepository::class, $container['EmployeeRepository']);
        $this->assertInstanceOf(JoiningYearService::class, $container['JoiningYearService']);
        $this->assertInstanceOf(FollowingYearService::class, $container['FollowingYearService']);
        $this->assertInstanceOf(NonApplicableService::class, $container['NonApplicableService']);
        $this->assertInstanceOf(EmployeeVacationDaysService::class, $container['EmployeeVacationDaysService']);
        $this->assertInstanceOf(TemplateService::class, $container['TemplateService']);
        $this->assertInstanceOf(VacationDaysApplication::class, $container['VacationDaysApplication']);
        $this->assertInstanceOf(ExceptionHandler::class, $container['ExceptionHandler']);
    }
}
