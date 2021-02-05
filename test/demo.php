<?php
require  __DIR__ . '/../vendor/autoload.php';

use App\src\Screenshoter;

$screenshoter = new Screenshoter('../input.xlsx', 'C');

$screenshoter->getScreenshots('../images');
    