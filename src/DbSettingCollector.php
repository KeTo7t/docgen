<?php

namespace KeTo7t\docgen;

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
            $this->tables[$tableName]["constraint_setting"] = $this->fetchConstraintSetting($tableName);
            $this->tables[$tableName]["foreign_constraint_setting"] = $this->fetchForeignConstraintSetting($tableName);
            $this->tables[$tableName]["trigger_setting"] = $this->fetchTriggerSetting($tableName);
        }
    }

    public function fetchColumnSetting($tableName): array
    {
        return $this->object2Array($this->connection->select("desc {$tableName}"));
    }

    public function fetchIndexSetting($tableName): array
    {
        return $this->object2Array($this->connection->select("show index from {$tableName}"));

    }

    public function fetchTableSetting(): array
    {
        return $this->object2Array($this->connection->select("SELECT * FROM information_schema.`TABLES` WHERE TABLES.table_schema='{$this->dbName}' "));
    }


    public function fetchConstraintSetting($tableName): array
    {
        $SQL="SELECT * FROM  INFORMATION_SCHEMA.TABLE_CONSTRAINTS AS TC  JOIN  INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS TU
 ON TC.Constraint_schema = TU.Constraint_schema 
AND TC.table_name =TU.table_name
AND TC.Constraint_name = TU.Constraint_name
WHERE TU.CONSTRAINT_SCHEMA='{$this->dbName}' AND TU.table_name='{$tableName}' 
AND TC.CONSTRAINT_TYPE <> 'FOREIGN KEY'";
        return $this->object2Array($this->connection->select($SQL));
    }
    public function fetchForeignConstraintSetting($tableName): array
    {
        $SQL="SELECT * FROM  INFORMATION_SCHEMA.TABLE_CONSTRAINTS AS TC  JOIN  INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS TU
 ON TC.Constraint_schema = TU.Constraint_schema 
AND TC.table_name =TU.table_name
AND TC.Constraint_name = TU.Constraint_name
WHERE TU.CONSTRAINT_SCHEMA='{$this->dbName}' AND TU.table_name='{$tableName}' 
AND TC.CONSTRAINT_TYPE = 'FOREIGN KEY'";
        return $this->object2Array($this->connection->select($SQL));
    }



    public function fetchTriggerSetting($tableName): array
    {
        return $this->object2Array($this->connection->select("SELECT * FROM information_schema.TRIGGERS WHERE EVENT_OBJECT_SCHEMA='{$this->dbName}'  AND EVENT_OBJECT_TABLE='{$tableName}'"));
    }

    function getTableDefinitions(): array
    {
        return $this->tables;
    }


    private function object2Array($object): array
    {
        return json_decode(json_encode($object), true);
    }
}