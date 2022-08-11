<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'tbl_pelanggan';

    protected $fillable = ['id', 'nama_pelanggan', 'no_hp', 'alamat', 'id_wilayah', 'status'];
}
