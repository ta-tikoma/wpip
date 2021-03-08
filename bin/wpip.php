<?php

use WPIP\WPIP;

require_once __DIR__ . '/../vendor/autoload.php';

$wpip = new WPIP(
    __DIR__ . '/../config/packages.php',
    __DIR__ . '/../config/packages.default.php',
);

$wpip->run();
