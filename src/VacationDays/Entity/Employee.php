<?php

declare(strict_types=1);

namespace VacationDays\Entity;

use DateTimeInterface;

class Employee
{
    private string $name;

    private DateTimeInterface $dateOfBirth;

    private DateTimeInterface $contractStartDate;

    private bool $isSpecialContract;

    private float $vacationDaysOfGivenYear;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDateOfBirth(): DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(DateTimeInterface $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getContractStartDate(): DateTimeInterface
    {
        return $this->contractStartDate;
    }

    public function setContractStartDate(DateTimeInterface $contractStartDate): void
    {
        $this->contractStartDate = $contractStartDate;
    }

    public function getIsSpecialContract(): bool
    {
        return $this->isSpecialContract;
    }

    public function setIsSpecialContract(bool $isSpecialContract): void
    {
        $this->isSpecialContract = $isSpecialContract;
    }

    public function getVacationDaysOfGivenYear(): float
    {
        return $this->vacationDaysOfGivenYear;
    }

    public function setVacationDaysOfGivenYear(float $vacationDaysOfGivenYear): void
    {
        $this->vacationDaysOfGivenYear = $vacationDaysOfGivenYear;
    }
}
