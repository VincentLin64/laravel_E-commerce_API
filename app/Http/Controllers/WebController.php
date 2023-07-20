<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function index() {
        $vProduct = Product::all();
        $user = User::find(1);
        $notifications = $user->notifications ?? [];
        return view('web.index', ['products'=>$vProduct, 'notifications' => $notifications]);
    }

    public function contactUs() {
        return view('web.contact_us');
    }
}
