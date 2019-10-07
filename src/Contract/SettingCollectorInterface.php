<?php

namespace KeTo7t\docGen\Contract;


interface  SettingCollectorInterface
{

    public function fetchTableSetting();

    public function fetchColumnSetting($tableName);

    public function fetchIndexSetting($tableName);




    public function fetchSettings();

}