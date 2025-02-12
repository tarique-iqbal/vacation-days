# Vacation days calculation
Determine the number of vacation days for each of its employees for a given year.
The script should take the year of interest as its only input argument and output the name of each
employee along with the respective number of vacation days for the given year.

### Requirements
- Each employee has a minimum of 26 vacation days
- A special contract can overwrite the minimum amount of vacation days
- Employees with an age >= 30 years get one additional vacation day every 5 years of
employment
- Contracts may start on the 1st or 15th of the month

## Prerequisites
```
composer
php (>=8.2)
```

## Note
The application will not work if [register_argc_argv](http://php.net/manual/en/ini.core.php#ini.register-argc-argv) is disabled.

## Installation and Run the script
- All the `code` required to get started
- Need write permission to following `directory`

`./var/logs`

- Install the script
```shell
$ cd /path/to/base/directory
$ composer install --no-dev
```

- Run the script and sample output

```shell
$ php index.php 2022
Hans Müller: 26
Angelika Fringe: 26
Peter Klever: 27
Marina Helter: 27
Sepp Meier: 26
```

```shell
$ php index.php 2020
Hans Müller: 27
Angelika Fringe: 27
Peter Klever: 28
Marina Helter: 26
Sepp Meier: 26
```

```shell
$ php index.php 2017
Hans Müller: 26
Angelika Fringe: 26
Peter Klever: 27
Marina Helter: Inapplicable
Sepp Meier: 2.16
```

## Running the tests

- Follow Install instructions.
Adapt `phpunit.xml.dist` PHP Constant according to your setup environment.

```shell
$ cd /path/to/base/directory
$ composer update
$ ./vendor/bin/phpunit tests
```

Test-cases, test unit and integration tests.