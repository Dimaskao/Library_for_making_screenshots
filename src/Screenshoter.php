<?php
namespace Dimaskao\Screenshoter;
use JonnyW\PhantomJs\Client;
use Dimaskao\Screenshoter\ExcelService;

final class Screenshoter
{

    private string $saveDir;

    public function __construct(string $saveDir)
    {
        $this->saveDir = $saveDir;
    }

    public function getScreenshots(string $excelPath, string $urlColumn, string $filnameColumn): void
    {
        $excel = new ExcelService($excelPath);
        $urlList = $excel->getUrlList($urlColumn);

        foreach ($urlList as $row => $url) {
            $client = Client::getInstance();
            $client->getEngine()->setPath('../bin/phantomjs'); //Set path to phantomjs. Default "../bin/phantomjs"
            $request = $client->getMessageFactory()->createCaptureRequest($url[0], 'GET');
            $filename = $this->getRandomFilename();
            $request->setOutputFile("$this->saveDir/$filename.jpg");
            $response = $client->getMessageFactory()->createResponse();
            $client->send($request, $response);

            if ($response->getStatus() == 0){
                continue;
            }

            $excel->writeExcelData($filnameColumn, ++$row, $filename . ".jpg");
        }
    }
    
    private function getRandomFilename(): string
    {
        return md5(microtime() . rand(0, 9999)) . microtime();
    }
}