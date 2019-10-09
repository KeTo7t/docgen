<?php


namespace KeTo7t\docgen\Factory;


use KeTo7t\docgen\Contract\FactoryInterface;
use KeTo7t\docgen\Library\Converter;
use KeTo7t\docgen\Writer\ExcelWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExcelWriterFactory implements FactoryInterface
{

   static function create()
    {
        $converter=new Converter();
        $spreadSheet= new Spreadsheet();
        $xlsx=new Xlsx($spreadSheet);
        return new ExcelWriter($converter,$xlsx,$spreadSheet);
    }

}