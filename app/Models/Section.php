<?php
// app/Models/Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    // public $timestamps = false;
    protected $guarded = ['created_at'];
    protected $fillable = [
        'judul','sub_judul', 'deskripsi', 'tipe_section', 'created_at',
        'updated_at'
    ];

}
