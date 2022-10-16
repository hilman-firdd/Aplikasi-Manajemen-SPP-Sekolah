<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadmin' => [
            'transaksi-spp' => 'c,r,u,d',
            'tabungan' => 'c,r,u,d',
            'keuangan' => 'c,r,u,d',
            'tagihan' => 'c,r,u,d',
            'siswa' => 'c,r,u,d',
            'kelas' => 'c,r,u,d',
            'periode' => 'c,r,u,d',
            'laporan' => 'c,r,u,d',
            'pengguna' => 'c,r,u,d',
        ],
        'admin' => [
            'tagihan' => 'c,r,u,d',
            'siswa' => 'c,r,u,d',
            'kelas' => 'c,r,u,d',
            'periode' => 'c,r,u,d',
        ],
        'kepsek' => [
            'laporan' => 'c,r,u,d',
        ],
        'bendahara' => [
            'transaksi-spp' => 'c,r,u,d',
            'tabungan' => 'c,r,u,d',
            'keuangan' => 'c,r,u,d',
            'tagihan' => 'c,r,u,d',
            'siswa' => 'c,r,u,d',
            'kelas' => 'c,r,u,d',
            'periode' => 'c,r,u,d',
        ],
        'siswa' => [
            'siswa' => 'r',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
