<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    // public $timestamps = false;
    protected $guarded = ['created_at'];
    protected $fillable = [
        'nama',
        'jabatan',
        'foto', 
        'created_at', 
        'updated_at'
    ];

}
