<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
// use Illuminate\Support\Facades\Hash;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('username', 'password');
            $token = JWTAuth::attempt($credentials);

            if (!$token) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }

            $user = auth()->user();
            $data = [
                'token' => $token,
                'expire_duration' => auth()->factory()->getTTL() * 60,
                'user' => [
                    'fullname' => $user->fullname,
                    'role' => $user->role,
                    'status' => $user->status,
                    'photo' => "https://cdn.vuetifyjs.com/images/john.png"
                ]
            ];
            return $this->successWithData($data);
        } catch (JWTException $e) {
            return $this->error($e->getMessage());
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
            return $this->success();
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }
    }

    // public function register(UserRequest $req)
    // {
    //     $attribute = $req->all();
    //     $attribute['password'] = Hash::make($attribute['password']);
    //     $user = User::create($attribute);

    //     $token = JWTAuth::fromUser($user);
    //     $data['data'] = [
    //         'user' => $user,
    //         'token' => $token
    //     ];
    //     return response()->json($data,201);
    // }
}
