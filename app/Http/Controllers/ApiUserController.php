<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    public function register(ApiRegisterRequest $request) {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
       if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
           $user = $request->user();
           $user->token = $user->createToken('App')->accessToken;
           return response()->json($user);
       }
       return response()->json(['errors' => ['email' => 'Email or Password is Incorrect']], 401);
    }

    public function userInfor(Request $request) {
        return response()->json($request->user('api'));
    }

}
