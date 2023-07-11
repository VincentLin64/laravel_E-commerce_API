<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(Request $request) {

        $iPage = $request->input('page',1);
        $orderCounts = Order::whereHas('orderItems')->count();
        $dataPerPage = 2;
        $orderPages = ceil($orderCounts / $dataPerPage) + 1;
        $vOrders = Order::orderBy('created_at', 'desc')
            ->with(['user','orderItems.product'])
            ->offset($dataPerPage * ($iPage - 1))
            ->limit($dataPerPage)
            ->whereHas('orderItems')
            ->get();

        $vReturnData = ['orders' => $vOrders, 'orderCount'=> $orderCounts, 'orderPages' => $orderPages];
        return view('admin.orders.index', $vReturnData);
    }
}
