<?php

foreach ($employees as $employee) {
    if (0.0 === $employee->getVacationDaysOfGivenYear()) {
        echo $employee->getName() . ': Not applicable' . PHP_EOL;
    } else {
        echo $employee->getName() . ': ' . $employee->getVacationDaysOfGivenYear() . PHP_EOL;
    }
}
