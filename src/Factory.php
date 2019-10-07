<?php


namespace KeTo7t\docGen;


class Factory
{


    function create($flag){


        if("excel"){
            return new DbSettingCollector();


        }


    }
}