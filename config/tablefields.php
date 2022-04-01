<?php

return [
    'tblname'    => [
        'field1','field2'
    ],
    'campaigns' => [
        'name' => [
            'label' => 'Nama'
        ],
        'summary' => [
            'type' => 'textarea',
            'label' => 'Ringkasan',
        ],
        'description' => [
            'type' => 'textarea',
            'label' => 'Deskripsi',
        ],
        'date_start' => [
            'label' => 'Tanggal Mulai',
            'type'  => 'date'
        ],
        'date_end' => [
            'label' => 'Tanggal Selesai',
            'type'  => 'date'
        ],
        'amount_target' => [
            'label' => 'Nominal Target',
            'type'  => 'number'
        ]
    ],
    'subjects' => [
        'name' => [
            'label' => 'Nama',
            'type' => 'text',
        ],
        'phone' => [
            'label' => 'No. HP',
            'type' => 'text',
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'text',
        ],
        'is_anonim' => [
            'label' => 'Anonim',
            'type' => 'text',
        ],
        'notes' => [
            'label' => 'Catatan',
            'type' => 'text',
        ],
        'NRA' => [
            'label' => 'NRA',
            'type' => 'text',
        ],
    ],
    'donations' => [
        'name' => [
            'label' => 'Nama'
        ],
        'summary' => [
            'type' => 'textarea',
            'label' => 'Ringkasan',
        ],
        'description' => [
            'type' => 'textarea',
            'label' => 'Deskripsi',
        ],
    ]
];