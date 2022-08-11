<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;

    protected $table = 'tbl_keluhan';

    protected $fillable = [
        'id_pelanggan', 'id_kategori', 'deskripsi', 'penyebab', 'status', 'id_teknisi', 'keterangan'
    ];
}
