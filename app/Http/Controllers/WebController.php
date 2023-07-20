<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class WebController extends Controller
{
    public $notifications = [];
    public function __construct()
    {
        $user = User::find(1);
        $this->notifications = $user->notifications ?? [];
    }

    //
    public function index() {
        $vProduct = Product::all();

        return view('web.index', ['products'=>$vProduct, 'notifications' => $this->notifications]);
    }

    public function contactUs() {
        return view('web.contact_us', ['notifications' => $this->notifications]);
    }

    public function readNotification(Request $request) {
        $vInput = $request->all();
        $id = $vInput['id'];
        DatabaseNotification::find($id)->markAsRead();
        return response(['result'=>true]);
    }
}
