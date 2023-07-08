<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function signup(CreateUser $request)
    {
        dd('test');
        $vValidatedData = $request->validated();
        $vUser = new User([
            'name' => $vValidatedData['name'],
            'email' => $vValidatedData['email'],
            'password' => bcrypt($vValidatedData['password']),
        ]);
        $vUser->save();
        return response('success', 201);

    }
}
