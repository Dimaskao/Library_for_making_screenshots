<?php
require  __DIR__ . '/../vendor/autoload.php';

use App\src\Screenshoter;

$screenshoter = new Screenshoter('../images');//path to screenshots storage

$screenshoter->getScreenshots('../input.xlsx', 'C', 'E');//path to excel file, column with url, the column in which the file name will be written
    