<?php
// app/Models/Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section2 extends Model
{
    protected $table = 'section2';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    // public $timestamps = false;
    protected $guarded = ['created_at'];
    protected $fillable = [
        'judul','gambar', 'deskripsi', 'tipe_section', 'created_at',
        'updated_at'
    ];

}
