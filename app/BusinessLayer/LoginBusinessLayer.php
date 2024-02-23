<?php

namespace App\BusinessLayer;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class LoginBusinessLayer
{
    public function aksiLogin(Request $request)
    {
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Admin::where($credentials)->exists()) {
            return true;
        }

        return false;
    }
}
