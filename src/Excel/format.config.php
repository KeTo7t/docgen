<?php
return [
    "column_width" => [
        "table_list_sheet" => [
            "B" => 4,
            "C" => 20,
            "D" => 35,
            "E" => 25,
            "F" => 40
        ]
        ,
        "table_define_sheet" => [
            "B" => 4,
            "C" => 30,
            "D" => 25,
            "E" => 15,
            "F" => 15,
            "G" => 30
        ]
    ],

    "list_style" => [
        "header_border" => [
            'borders' => [
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
            ],
        ],

        "header_color" => [
            'fill' => ["fillType" => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '90ee90',],
            ]
        ]
        ,
        "outline_border" => [
            'borders' => [
                'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
                'vertical' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
                'horizontal' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,],
            ],
        ],
        "body_border" => [
            'borders' => [
                'inline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,],
            ],
        ],
    ]
];