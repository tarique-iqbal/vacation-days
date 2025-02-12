<?php

declare(strict_types=1);

use VacationDays\Container\ContainerFactory;

ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'Off');

const BASE_DIR = __DIR__;

if (PHP_SAPI !== 'cli') {
    die('Please run the application from command line.');
}

require_once BASE_DIR . '/vendor/autoload.php';
$config = require BASE_DIR . '/config/parameters.php';

$container = (new ContainerFactory($config))->create();

set_exception_handler([$container['ExceptionHandler'], 'report']);

$container['VacationDaysApplication']->calculate();
