<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $payload = $request->all();
        $user = User::where('email',$payload['email'])
                    ->where('password',$payload['password'])
                    ->first();
        if ($user){
                $user->token = $user->createToken('authToken')->accessToken;
                return response()->json([
                    'status'=>true,
                    'data'=>$user
                ]);
        }
        else return response()->json([
            'status'=>false,
        ]);
    }
}
