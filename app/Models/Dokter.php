<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['created_at'];
    protected $fillable = [
        'nama_dokter',
        'nama_dokter2',
        'jam_praktek',
        'jam_praktek2',
        'hari', 
        'created_at', 
        'updated_at'
    ];

}
