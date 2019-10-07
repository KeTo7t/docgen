<?php

namespace KeTo7t\docgen\Excel;

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

    /**　処理実行
     * @param $tables
     * @param $filename
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function run($tables, $filename)
    {
        $this->createTableListSheet($tables);
        $this->createEachTableSheet($tables);

        $writer = $this->xlsx->setSpreadsheet($this->spreadsheet);
        $writer->save($filename . ".xlsx");
    }


    /**テーブル一覧シートの作成
     * 
     * @param $tables
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function createTableListSheet($tables)
    {
        $currentSheet = $this->spreadsheet->getSheet(0);

        $currentSheet->setTitle("テーブル一覧");
        $tablesArray = array_column($tables, "table_setting");
        $this->setList($currentSheet, 1, $tablesArray, "テーブル一覧", "tables");
        $currentSheet->getStyle("B1")->getFont()->setSize(18);
        $this->setColumnsWidth($currentSheet, "table_sheet");

    }

    /**各テーブルの定義情報シート作成
     * @param $tables
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function createEachTableSheet($tables)
    {

        foreach ($tables as $key => $table) {

            $currentSheet = $this->spreadsheet->createSheet();
            $currentSheet->setTitle($key);
            $currentSheet->getCell("B1")->setValue("テーブル:" . $key);
            $currentSheet->getStyle("B1")->getFont()->setSize("18");
            $lastRow = 0;
            $lastRow = $this->setList($currentSheet, 2, $table["column_setting"], "■カラム情報", "columns");
            $lastRow =$this->setList($currentSheet, $lastRow + 2, $table["index_setting"], "■インデックス情報", "indexes");
            $lastRow=$this->setList($currentSheet, $lastRow + 2, $table["constraint_setting"], "■制約情報", "constraints");
            $lastRow=$this->setList($currentSheet, $lastRow + 2, $table["foreign_constraint_setting"], "■外部制約情報", "constraints");
            $lastRow=$this->setList($currentSheet, $lastRow + 2, $table["trigger_setting"], "■トリガー情報", "triggers");
            $this->setColumnsWidth($currentSheet, "column_sheet");
        }
    }

    /**　各表組のデータ挿入
     * @param Worksheet $currentSheet
     * @param $baseRow
     * @param $targetArray
     * @param $caption
     * @param $headerType
     * @return int
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
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

        $this->setListFormat($currentSheet, $range->getRange(), $merged);

        return $baseRow + $rowCount;

    }



    /**ヘッダ付きリストのフォーマット設定
     * @param Worksheet $currentSheet
     * @param $baseCell
     * @param array $rows
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function setListFormat(Worksheet $currentSheet, $baseCell, array $rows)
    {
        $range = new Range(Coordinate::rangeBoundaries($baseCell));

        $colsCount = count($rows[0]) - 1;
        $rowsCount = count($rows) - 1;


        $this->setHeaderFormat($currentSheet, $range, $colsCount);

        $styleArray = config("phpSpreadSheet_styles.outline_border");

        $range->setOffset(null, null, $rowsCount, $colsCount);

        $currentSheet->getStyle($range->getRange())->applyFromArray($styleArray);

    }

    /**ヘッダ行の書式設定
     * @param Worksheet $currentSheet
     * @param Range $range
     * @param $colsCount
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function setHeaderFormat(Worksheet $currentSheet, Range $range, $colsCount)
    {

        $styleArray = config("phpSpreadSheet_styles.header_border")
            + config("phpSpreadSheet_styles.header_color");

        $offset = $range->getOffset(null, null, 0, $colsCount);

        $currentSheet->getStyle($offset)->applyFromArray($styleArray);

    }

    /**リスト行の書式設定
     * @param Worksheet $currentSheet
     * @param Range $range
     * @param $rowsCount
     * @param $colsCount
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function setBodyFormat(Worksheet $currentSheet, Range $range,$rowsCount, $colsCount)
    {

        $styleArray = config("phpSpreadSheet_styles.header_border")
            + config("phpSpreadSheet_styles.header_color");

        $offset = $range->getOffset(null, null, $rowsCount, $colsCount);

        $currentSheet->getStyle($offset)->applyFromArray($styleArray);

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




}