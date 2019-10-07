<?php

namespace KeTo7t\docGen\Excel;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelWriter
{

    private $spreadsheet, $xlsx, $converter, $format;

    public function __construct(Spreadsheet $spreadsheet, Xlsx $xlsx, Converter $converter)
    {
        $this->spreadsheet = $spreadsheet;
        $this->xlsx = $xlsx;
        $this->converter = $converter;
        $this->format = require "format.config.php";
    }

    public function run($tables, $filename)
    {
        $this->createTableListSheet($tables);
        $this->createColumnListSheet($tables);

        $writer = $this->xlsx->setSpreadsheet($this->spreadsheet);
        $writer->save($filename . ".xlsx");
    }


    private function createTableListSheet($tables)
    {
        $currentSheet = $this->spreadsheet->getSheet(0);

        $currentSheet->setTitle("テーブル一覧");
        $tablesArray = array_column($tables, "table_setting");
        $this->setList($currentSheet, 1, $tablesArray, "テーブル一覧", "tables");
        $currentSheet->getStyle("B1")->getFont()->setSize(18);
        $this->setColumnsWidth($currentSheet, "table_sheet");

    }

    private function createColumnListSheet($tables)
    {

        foreach ($tables as $key => $table) {

            $currentSheet = $this->spreadsheet->createSheet();
            $currentSheet->setTitle($key);
            $currentSheet->getCell("B1")->setValue("テーブル:" . $key);
            $currentSheet->getStyle("B1")->getFont()->setSize("18");
            $lastRow = 0;
            $lastRow = $this->setList($currentSheet, 2, $table["column_setting"], "■テーブル定義", "columns");
            $this->setList($currentSheet, $lastRow + 3, $table["index_setting"], "■インデックス定義", "indexes");
            $this->setColumnsWidth($currentSheet, "column_sheet");
        }
    }

    private function setTableFormat(Worksheet $currentSheet, $baseCell, array $rows)
    {
        $range = new Range(Coordinate::rangeBoundaries($baseCell));

        $colsCount = count($rows[0]) - 1;
        $rowsCount = count($rows) - 1;


        $this->setHeaderFormat($currentSheet, $range, $colsCount);

        $styleArray = config("phpSpreadSheet_styles.outline_border");

        $range->setOffset(null, null, $rowsCount, $colsCount);

        $currentSheet->getStyle($range->getRange())->applyFromArray($styleArray);

    }

    /**シート内のカラムの幅を設定
     * @param $currentSheet
     * @param $key
     */
    private function setColumnsWidth($currentSheet, $key) :void
    {
        $formats = $this->format[$key]["width"];
        foreach ($formats as $key => $width) {
            $currentSheet->getColumnDimension($key)->setWidth($width);
        }

    }



    private function setHeaderFormat(Worksheet $currentSheet, Range $range, $colsCount)
    {

        $styleArray = config("phpSpreadSheet_styles.header_border")
            + config("phpSpreadSheet_styles.header_color");

        $offset = $range->getOffset(null, null, 0, $colsCount);

        $currentSheet->getStyle($offset)->applyFromArray($styleArray);

    }
    private function setBodyFormat(Worksheet $currentSheet, Range $range,$rowsCount, $colsCount)
    {

        $styleArray = config("phpSpreadSheet_styles.header_border")
            + config("phpSpreadSheet_styles.header_color");

        $offset = $range->getOffset(null, null, $rowsCount, $colsCount);

        $currentSheet->getStyle($offset)->applyFromArray($styleArray);

    }



    private function setList(Worksheet $currentSheet, $baseRow, $targetArray, $caption, $headerType): int
    {
        $baseCell = "B" . $baseRow;
        $range = new Range($baseCell);

        //表タイトルを挿入
        $currentSheet->getCell($baseCell)->setValue($caption);
        $range->setOffset(1);

        //表データの用意

        $merged = $this->converter->getList($headerType, $targetArray);

        $rowCount = count($merged);
        $currentSheet = $currentSheet->fromArray($merged, null, $range->getRange());

        $this->setTableFormat($currentSheet, $range->getRange(), $merged);

        return $baseRow + $rowCount;

    }

}