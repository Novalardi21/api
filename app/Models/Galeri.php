<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    // public $timestamps = false;
    protected $guarded = ['created_at'];
    protected $fillable = [
        'gambar', 'created_at', 'updated_at'
    ];

}
