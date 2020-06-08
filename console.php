<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use FizzBuzz\FizzBuzzCommand;

$application = new Application();
$application->add(new FizzBuzzCommand());
$application->run();
