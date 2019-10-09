<?php
return [
    //テーブル一覧シートに表示する列名
    "tables" => [
        "TABLE_SCHEMA" => "データベース名",
        "TABLE_NAME" => "テーブル名",
        "TABLE_COLLATION" => "文字コード",
        "TABLE_COMMENT" => "備考",
//        "TABLE_CATALOG" => null,
//        "TABLE_TYPE" => null,
//        "ENGINE" => null,
//        "VERSION" => null,
//        "ROW_FORMAT" => null,
//        "TABLE_ROWS" => null,
//        "AVG_ROW_LENGTH" => null,
//        "DATA_LENGTH" => null,
//        "MAX_DATA_LENGTH" => null,
//        "INDEX_LENGTH" => null,
//        "DATA_FREE" => null,
//        "AUTO_INCREMENT" => null,
//        "CREATE_TIME" => null,
//        "UPDATE_TIME" => null,
//        "CHECK_TIME" => null,
//        "CHECKSUM" => null,
//        "CREATE_OPTIONS" => null,
    ],


    //テーブル定義シートに表示するカラム一覧の列名
    "columns" => [
        "Field" => "カラム名",
        "Type" => "データ型",
        "Null" => "Null許容",
        "Key" => "キー",
        "Default" => "デフォルト値",
//        "Extra" => null,
    ],


    //テーブル定義シートに表示するインデックス一覧の列名
    "indexes" => [
        "Key_name" => "インデックス名",
        "Column_name" => "対象カラム",
        "Index_type" => "アルゴリズム",
        "Non_unique" => "ユニーク",
        "Comment" => "備考",
//        "Table" => null,
//        "Seq_in_index" => null,
//        "Collation" => null,
//        "Cardinality" => null,
//        "Sub_part" => null,
//        "Packed" => null,
//        "Null" => null,
//        "Index_comment" => null,
//        "Visible" => null
    ],


    //テーブル定義シートに表示する制約一覧の列名
    "constraints" => [
        "CONSTRAINT_NAME" => "制約名",
        "TABLE_NAME" => "テーブル名",
        "COLUMN_NAME" => "カラム名",
        "REFERENCED_TABLE_NAME" => "外部テーブル",
        "REFERENCED_COLUMN_NAME" => "外部キー",
//        "CONSTRAINT_CATALOG" => null,
//        "CONSTRAINT_SCHEMA" => null,
//        "TABLE_CATALOG" => null,
//        "TABLE_SCHEMA" => null,
//        "ORDINAL_POSITION" => null,
//        "POSITION_IN_UNIQUE_CONSTRAINT" => null,
//        "REFERENCED_TABLE_SCHEMA" => null,
    ],


    //テーブル定義シートに表示するトリガー一覧の列名
    "triggers" => [
        "TRIGGER_NAME" => "トリガー名",
        "EVENT_MANIPULATION" => "イベント",
        "ACTION_ORIENTATION" => "実行単位",
        "ACTION_TIMING" => "タイミング",
        "ACTION_CONDITION" => "実行条件",
//        "TRIGGER_CATALOG"=>null,
//        "TRIGGER_SCHEMA"=>null,
//        "EVENT_OBJECT_CATALOG"=>null,
//        "EVENT_OBJECT_SCHEMA"=>null,
//        "EVENT_OBJECT_TABLE"=>null,
//        "ACTION_ORDER"=>null,
//        "ACTION_STATEMENT"=>null,
//        "ACTION_REFERENCE_OLD_TABLE"=>null,
//        "ACTION_REFERENCE_NEW_TABLE"=>null,
//        "ACTION_REFERENCE_OLD_ROW"=>null,
//        "ACTION_REFERENCE_NEW_ROW"=>null,
//        "CREATED"=>null,
//        "SQL_MODE"=>null,
//        "DEFINER"=>null,
//        "CHARACTER_SET_CLIENT"=>null,
//        "COLLATION_CONNECTION"=>null,
//        "DATABASE_COLLATION"=>null

    ]


];