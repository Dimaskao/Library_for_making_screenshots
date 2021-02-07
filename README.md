# Library for making screenshots 
With this library you can make page screenshot with PHP script automatically.
## General
In your Excel file must be the column with url and empty column on the right or left of url to saving file name. You can specify them in `->getScreenshots()` method.
## Installation
You can use composer to install this extension.

Just run:
```
$composer require dimaskao/library_for_serializing_objects
```
## How to use
At first include this library classes: 
```php
require_once __DIR__ . '/XXXXX/vendor/autoload.php';

use Dimaskao\Screenshoter\Screenshoter;
```
Where:  
`XXXXX` path to library root folder;   

Then use `->getScreenshots()` method
```php
$screenshoter = new Screenshoter('path/to/folder');//in tis folder will be saving screenshots

$screenshoter->getScreenshots('dir/', 'B', 'C');
```
`dir/` - path to excel file  
`B` - colunm with url  
`C` - column to save filename