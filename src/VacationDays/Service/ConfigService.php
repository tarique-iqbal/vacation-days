<?php

declare(strict_types=1);

namespace VacationDays\Service;

final class ConfigService implements ConfigServiceInterface
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getEmployeeDataSourceFile(): string
    {
        return BASE_DIR
            . '/' . $this->config['data_source']['directory']
            . '/' . $this->config['data_source']['file_name'];
    }

    public function getErrorLogFile(): string
    {
        return BASE_DIR
            . '/' . $this->config['error_log']['directory']
            . '/' . $this->config['error_log']['file_name'];
    }
}
