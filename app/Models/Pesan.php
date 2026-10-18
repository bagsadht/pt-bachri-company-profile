<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    // Beri tahu Laravel kalau nama tabelnya adalah 'pesan' (bukan 'pesans')
    protected $table = 'pesan';

    protected $fillable = [
        'nama',
        'email',
        'isi_pesan',
    ];
}