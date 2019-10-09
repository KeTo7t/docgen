<?php
namespace KeTo7t\docgen\Factory;

use Illuminate\Database\Schema\Builder;
use KeTo7t\docgen\Contract\FactoryInterface;
use KeTo7t\docgen\Collector\DbCollector;



class DBSettingFactory implements FactoryInterface
{

   static function create()
    {
        return new DbCollector(app(Builder::class));

    }

}