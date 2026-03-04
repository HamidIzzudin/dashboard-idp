<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('Test koneksi Gmail SMTP dari IDP Dashboard berhasil!', function ($message) {
        $message->to('prasetyoguntur045@gmail.com')
                ->subject('Test Email - IDP Dashboard');
    });
    echo "OK: Email berhasil dikirim! Cek inbox Gmail Anda.\n";
} catch (\Exception $e) {
    echo "GAGAL: " . $e->getMessage() . "\n";
}
