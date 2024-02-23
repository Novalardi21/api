<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    protected $table = 'daftar';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['created_at'];
    protected $fillable = [
        'nama_pasien',
        'ttl',
        'jenis_kelamin',
        'telepon',
        'alamat', 
        'status',
        'created_at', 
        'updated_at'
    ];

}
