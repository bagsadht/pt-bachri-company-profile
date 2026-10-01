<?php

return [
    // Password untuk masuk ke panel admin (/admin)
    'password' => env('ADMIN_PASSWORD'),

    // Email tujuan notifikasi lamaran masuk
    'notify_email' => env('ADMIN_NOTIFY_EMAIL', 'bachrisamuderaindonesia@gmail.com'),
];