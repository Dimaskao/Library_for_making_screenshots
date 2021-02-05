<?php
namespace App\src;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;

final class ExcelService
{

    private Spreadsheet $spreadsheet;
    private $excelFilename;

    public function __construct(string $excelFilename)
    {
        $this->excelFilename = $excelFilename;
        $reader = new XlsxReader();
        $reader->setReadDataOnly(TRUE);
        $this->spreadsheet = $reader->load($excelFilename);
    }

    public function writeExcelData(string $column, string $row, string $data): void
    {
        $this->spreadsheet->getActiveSheet()->setCellValue($column . $row, $data);
        $writer = new Xlsx($this->spreadsheet);
        $writer->save($this->excelFilename);
    }

    public function getUrlList(string $column): array
    {
        $lastCell = $this->getLastCell($column);
        $firstCell = $column . 1;
        return $this->spreadsheet->getActiveSheet()->rangeToArray($firstCell.':'.$lastCell);
    }

    private function getLastCell(string $column): string
    {
        $higestRow = $this->spreadsheet->getActiveSheet()->getHighestRow();
        return $column . $higestRow;
    }
}