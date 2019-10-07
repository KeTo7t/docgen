<?php

namespace KeTo7t\docGen;

use Illuminate\Database\Schema\Builder;


class DbSettingCollector implements Contract\SettingCollectorInterface
{
    private $connection, $dbName, $tables;

    function __construct(Builder $builder)
    {
        $this->connection = $builder->getConnection();
        $this->dbName = $this->connection->getDatabaseName();
    }


    function execute()
    {
        $this->fetchSettings();
    }

    public function fetchSettings()
    {
        $tables = array_column($this->fetchTableSetting(), null, "TABLE_NAME");
        $this->tables = array_map(function ($tableRow) {
            return ["table_setting" => $tableRow];
        }, $tables);

        foreach ($this->tables as $tableName => $value) {
            $this->tables[$tableName]["column_setting"] = $this->fetchColumnSetting($tableName);
            $this->tables[$tableName]["index_setting"] = $this->fetchIndexSetting($tableName);
        }
    }

    public function fetchColumnSetting($tableName)
    {
        return $this->object2Array($this->connection->select("desc {$tableName}"));
    }

    public function fetchIndexSetting($tableName)
    {
        return $this->object2Array($this->connection->select("show index from {$tableName}"));

    }

    public function fetchTableSetting()
    {
        //$tables = $this->connection->select("show tables");
        return $this->object2Array($this->connection->select("SELECT * FROM information_schema.`TABLES` WHERE TABLES.table_schema='{$this->dbName}' "));
    }


//    public function fetchConstraintSetting($tableName){
//        $this->object2Array($this->connection->select("SELECT * FROM Information_schema.KEY_COLUMN_USAGE WHERE
//    }

    function getTableDefinitions()
    {
        return $this->tables;
    }


    private function object2Array($object)
    {
        return json_decode(json_encode($object), true);
    }
}