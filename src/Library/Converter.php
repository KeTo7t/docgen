<?php
namespace KeTo7t\docgen\Library;
use Illuminate\Support\Facades\Config;

class Converter
{
    private $convertTable;

    function __construct()
    {
        $this->convertTable = Config::get("convert");
    }

    function formListArray($type, $targetArray,$setRowNumber=true)
    {

        $headerRow = $this->tableHeader($type);
        if($setRowNumber){
            array_unshift($headerRow,"No");
        }
        $dataRow = $this->arrayProjection($targetArray, $headerRow,$setRowNumber);
        return array_merge([array_values($headerRow)], $dataRow);
    }


    function arrayProjection($rowData, $tableHeader,$setRowNumber)
    {
        $result = [];

        //表の列を制限するとともに表示用に列の順番を入れ替える
        foreach($rowData as $index => $row) {
            if($setRowNumber){
                //表示用に配列要素番号に1を加算
               array_unshift( $row,$index + 1 );
            }

            foreach ($tableHeader as $key => $value) {
                $result[$index][] = $row[$key];
            }
        }

        return $result;
    }

    function tableHeader($type)
    {

        return array_filter($this->convertTable[$type], function ($value) {
            return isset($value);
        });

    }
}