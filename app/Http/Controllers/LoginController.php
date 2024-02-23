<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLayer\LoginBusinessLayer; 

class LoginController extends Controller
{
    private $loginBusinessLayer;

    public function __construct(LoginBusinessLayer $loginBusinessLayer)
    {
        $this->loginBusinessLayer = new LoginBusinessLayer;
    }

    public function login(Request $request)
    {
        $result = $this->loginBusinessLayer->aksiLogin($request);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Login Berhasil'], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
