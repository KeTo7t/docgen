<?php


namespace KeTo7t\docgen;


use Illuminate\Support\Facades\Config;
use KeTo7t\docgen\Contract\CollectorInterface;
use KeTo7t\docgen\Contract\WriterInterface;
use KeTo7t\docgen\Factory\DBSettingFactory;
use KeTo7t\docgen\Factory\DummyWriterFactory;
use KeTo7t\docgen\Factory\ExcelWriterFactory;

class Factory
{
    private $writerClasses,$collectorClasses;

    public function __construct()
    {
        $this->writerClasses=Config::get("factory.writer");
        $this->collectorClasses=Config::get("factory.collector");
    }

    function createWriter($flag):WriterInterface{
        return $this->writerClasses[$flag]::create();

    }


    function createCollector($flag):CollectorInterface{

         return   $this->collectorClasses[$flag]::create();


    }


}