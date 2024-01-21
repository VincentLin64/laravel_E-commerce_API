<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

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
        $sLoginType = $request->route()->getPrefix();
        $vInput = $request->validate($vRule);
        if (!Auth::attempt($vInput)) {
            if ($sLoginType === 'api') {
                return response('授權失敗', 401);
            } else {
                return Redirect::back()->withErrors(['msg' => '帳號密碼有誤']);
            }
        }
        $user = $request->user();
        $sToken = $user->createToken('Token');
        $sToken->token->save();
        Session::put('access_token', $sToken->accessToken);
        if ($sLoginType === 'api') {
            return response(['token' => $sToken->accessToken]);
        } else {
            Auth::login($user);
            if ($user->is_admin) {
                return redirect('/admin/orders');
            } else {
                return redirect('/');
            }
        }
    }

    public function user(Request $request)
    {
        return response($request->user());
    }

    public function logout(Request $request)
    {
        $sGetPrefix = $request->route()->getPrefix();
        if ($sGetPrefix === 'api') {
            $request->user()->token()->revoke();
            return response(['message' => '登出成功']);
        } else {
            Auth::logout();
            return redirect('/');

        }
    }
}
