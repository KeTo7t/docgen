<?php

return [
    "writer" => [
        "excel" => KeTo7t\docgen\Factory\ExcelWriterFactory::class,
        "dummy" => KeTo7t\docgen\Factory\DummyWriterFactory::class
    ] ,
    "collector" => [
        "DB" => KeTo7t\docgen\Factory\DBSettingFactory::class,
        "dummy" => KeTo7t\docgen\Factory\dummyCollectorFactory::class

    ]
];
