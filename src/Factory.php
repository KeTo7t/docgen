<?php


namespace KeTo7t\docgen;


class Factory
{


    function create($flag){


        if("excel"){
            return new DbSettingCollector();


        }


    }
}