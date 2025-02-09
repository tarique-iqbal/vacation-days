<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use VacationDays\Exception\FileNotFoundException;
use VacationDays\Service\TemplateService;

class TemplateServiceTest extends TestCase
{
    public function testRenderFileNotFound(): void
    {
        $this->expectException(FileNotFoundException::class);

        $templateService = new TemplateService();

        $templateService->render('/path/to/invalid/file/location', []);
    }
}
