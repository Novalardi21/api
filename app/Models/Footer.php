<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footer';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['created_at'];
    protected $fillable = [
        'judul_footer',
        'alamat',
        'telepon',
        'email',
        'created_at', 
        'updated_at'
    ];

}
