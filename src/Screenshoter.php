<?php
namespace App\src;
use JonnyW\PhantomJs\Client;
use App\src\ExcelService;

final class Screenshoter
{

    private ExcelService $excel;
    private array $urlList;

    public function __construct(string $filename, string $raw)
    {
        $this->excel = new ExcelService($filename);
        $this->urlList = $this->excel->getUrlList($raw);
    }

    public function getScreenshots(string $path): void
    {
        foreach ($this->urlList as $row => $url) {
            $client = Client::getInstance();
            //$client->getEngine()->setPath('../bin/phantomjs'); TODO: исправить проблему с подгрузкой файла
            $request = $client->getMessageFactory()->createCaptureRequest($url[0], 'GET');
            $filename = $this->getRandomFilename();
            $request->setOutputFile("$path/$filename.jpg");
            $response = $client->getMessageFactory()->createResponse();
            $client->send($request, $response);

            if ($response->getStatus() == 0){
                continue;
            }
            $this->excel->writeExcelData('E' , ++$row, $filename . ".jpg");
        
        }
    }
    
    private function getRandomFilename(): string
    {
        return md5(microtime() . rand(0, 9999)) . microtime();
    }
}