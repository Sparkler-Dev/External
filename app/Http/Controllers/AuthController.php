<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(){
       return response()->json([
            'message'=>'Login Request'
        ]);;
    }

    public function register(){
        return response()->json([
            'message'=>'Register Request'
        ]);
    }

     public function logout(){
        return response()->json([
            'message'=>'Logout Request'
        ]);
    }
}
