<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public $notifications = [];
    public function __construct()
    {
        
    }

    //
    public function index() {
        $vProduct = Product::all();
        return view('web.index', ['products'=>$vProduct, 'notifications' => $this->getNotification()]);
    }

    public function contactUs() {
        return view('web.contact_us', ['notifications' => $this->getNotification()]);
    }

    public function readNotification(Request $request) {
        $vInput = $request->all();
        $id = $vInput['id'];
        DatabaseNotification::find($id)->markAsRead();
        return response(['result'=>true]);
    }

    public function getNotification(){
        $user = Auth::user();
        return $user->notifications ?? [];
    }
}
