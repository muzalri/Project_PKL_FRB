<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;

    protected $table = 'tbl_teknisi';

    protected $fillable = ['id', 'nama', 'jabatan', 'nik', 'no_hp', 'alamat' , 'status'];
    
    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;
}
