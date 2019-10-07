<?php


namespace KeTo7t\docGen\Excel;


class Converter
{
    private $convertTable;

    function __construct()
    {
        $this->convertTable = require "convertTable.config.php";
    }

    function getList($type, $targetArray)
    {
        $headerRow = $this->tableHeader($type);
        $dataRow = $this->arrayProjection($targetArray, $headerRow);
        return array_merge([array_values($headerRow)], $dataRow);
    }


    function arrayProjection($rowData, $tableHeader)
    {
        $count = count($rowData);
        $result = [];

        //表の列を制限するとともに表示用に列の順番を入れ替える
        for ($i = 0; $i < $count; ++$i) {
            foreach ($tableHeader as $key => $value) {
                $result[$i][] = $rowData[$i][$key];
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