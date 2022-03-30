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
        'name' => 'Nama',
        'phone' => 'No. HP',
        'email' => 'Email',
        'is_anonim' => 'Anonim',
        'notes' => 'Catatan',
        'NRA' => 'NRA',
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
        'date_start' => [
            'label' => 'Tanggal Mulai',
            'type'  => 'date'
        ],
        'date_end' => [
            'label' => 'Tanggal Selesai',
            'type'  => 'date'
        ]
    ]
];