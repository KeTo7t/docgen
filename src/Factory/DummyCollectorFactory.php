<?php


namespace KeTo7t\docgen\Factory;

use KeTo7t\docgen\Contract\FactoryInterface;
use KeTo7t\docgen\Collector\dummyCollector;


class DummyCollectorFactory implements FactoryInterface
{

   static function create()
    {
        return new dummyCollector();
    }

}