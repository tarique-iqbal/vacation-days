<?php

declare(strict_types=1);

namespace Tests\Unit\Repository;

use bovigo\vfs\vfsDirectory;
use bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use VacationDays\Entity\Employee;
use VacationDays\Repository\EmployeeRepository;

class EmployeeRepositoryTest extends TestCase
{
    private vfsDirectory $root;

    protected function setUp(): void
    {
        $structure = [
            'data' => [
                'employees.json' => '{
                    "employees": {
                    "1": {
                        "name": "Hans Müller",
                            "dateOfBirth": "30.12.1970",
                            "contractStartDate": "01.07.2001",
                            "isSpecialContract": "no"
                        }
                    }
                }'
            ]
        ];

        $this->root = vfsStream::setup(sys_get_temp_dir(), null, $structure);
    }

    public function testFindAll()
    {
        $employeeRepository = new EmployeeRepository(
            $this->root->url() . '/data/employees.json'
        );

        $employees = $employeeRepository->findAll();

        $this->assertContainsOnlyInstancesOf(Employee::class, $employees);
    }
}
