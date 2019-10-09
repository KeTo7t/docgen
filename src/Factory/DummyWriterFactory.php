<?php


namespace KeTo7t\docgen\Factory;

use KeTo7t\docgen\Contract\FactoryInterface;
use KeTo7t\docgen\dummyWriter;


class DummyWriterFactory implements FactoryInterface
{

   static function create()
    {
        return new dummyWriter();
    }

}