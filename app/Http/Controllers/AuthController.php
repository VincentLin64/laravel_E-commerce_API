<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function signup(CreateUser $request)
    {
        $vValidatedData = $request->validated();
        $vUser = new User([
            'name' => $vValidatedData['name'],
            'email' => $vValidatedData['email'],
            'password' => bcrypt($vValidatedData['password']),
        ]);
        $vUser->save();
        return response('success', 201);

    }

    public function login(Request $request)
    {
        $vRule = [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
        $vInput = $request->validate($vRule);
        if (!Auth::attempt($vInput)) {
            return response('授權失敗', 401);
        }
        $user = $request->user();
        $sToken = $user->createToken('Token');
        $sToken->token->save();
        return response(['token' => $sToken->accessToken]);
    }
    public function user(Request $request){
        return response($request->user());
    }
    public function logout (Request $request){
        $request->user()->token()->revoke();
        return response(['message'=>'登出成功']);
    }
}
