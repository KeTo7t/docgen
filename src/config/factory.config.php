<?php

return [
    "writerClass" => [
        "excel" => ExcelWriterFactory::class,
        "dummy" => DummyWriterFactory::class
    ] ,
    "collectorClass" => [
        "DB" => DBSettingFactory::class,
        "dummy" => dummyCollectorFactory::class

    ]
];
