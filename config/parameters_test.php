<?php

declare(strict_types=1);

$config = [
    'data_source' => [
        'directory' => 'var/data',
        'file_name' => 'test_employees.json'
    ],
    'error_log' => [
        'directory' => 'var/logs',
        'file_name' => 'test_errors.log'
    ],
];

return $config;
