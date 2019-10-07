<?php
return [

    "header_border" => [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

            ],
        ],
    ],

    "header_color" => [
        'fill' => [
            "fillType" => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'color' => ['rgb' => '90ee90',],
        ]
    ]
    ,
    "outline_border" => [
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

            ],'vertical' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

            ],
            'horizontal' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,

            ],
        ],
    ],
    "body_border" => [
        'borders' => [
            'inline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
            ],
        ],
    ],

];