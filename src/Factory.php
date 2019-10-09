<?php


namespace KeTo7t\docgen;


use KeTo7t\docgen\Contract\CollectorInterface;
use KeTo7t\docgen\Contract\WriterInterface;
use KeTo7t\docgen\Factory\DBSettingFactory;
use KeTo7t\docgen\Factory\DummyWriterFactory;
use KeTo7t\docgen\Factory\ExcelWriterFactory;

class Factory
{
    private $writerClasses=[
        "excel"=>ExcelWriterFactory::class,
        "dummy"=>DummyWriterFactory::class

    ];

    private $collectorClasses=[
        "DB"=> DBSettingFactory::class,
        "dummy"=>dummyCollectorFactory::class

    ];

    function createWriter($flag):WriterInterface{
        return $this->writerClasses[$flag]::create();

    }


    function createCollector($flag):CollectorInterface{

         return   $this->collectorClasses[$flag]::create();


    }


}