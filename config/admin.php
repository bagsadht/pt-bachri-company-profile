<?php

return [
    // Password awal akun Admin (dipakai UserSeeder)
    'password' => env('ADMIN_PASSWORD'),

    // Password awal akun HRD (dipakai UserSeeder)
    'hrd_password' => env('HRD_PASSWORD'),

    // Email tujuan notifikasi lamaran masuk
    'notify_email' => env('ADMIN_NOTIFY_EMAIL', 'bachrisamuderaindonesia@gmail.com'),
];