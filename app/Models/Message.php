<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'pesan';

    protected $fillable = ['nama', 'email', 'isi_pesan'];
}