<?php


namespace KeTo7t\docgen\Factory;


use KeTo7t\docgen\Contract\FactoryInterface;
use KeTo7t\docgen\Library\Converter;
use KeTo7t\docgen\Writer\MarkDownWriter;

class MarkDownWriterFactory implements FactoryInterface
{

   static function create()
    {
        $converter=new Converter();
        return new MarkDownWriter($converter);
    }

}