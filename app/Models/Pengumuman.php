<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['created_at'];
    protected $fillable = [
        'judul',
        'isi',
        'foto', 
        'created_at', 
        'updated_at'
    ];

}
