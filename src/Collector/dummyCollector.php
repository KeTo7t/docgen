<?php

namespace KeTo7t\docgen\Collector;
use KeTo7t\docGen\Contract\CollectorInterface;

class dummyCollector implements CollectorInterface
{
    public function fetchTableSetting(){
        return null;
    }

    public function fetchColumnSetting($tableName){
        return null;
    }

    public function fetchIndexSetting($tableName){
        return null;
    }


    public function fetchSettings(){
        return null;
    }



}