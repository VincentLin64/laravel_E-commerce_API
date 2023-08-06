<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\OrderDelivery;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function delivery($id){
        $vOrder = Order::find($id);
        if ($vOrder->is_shipped){
            return response(['result'=> false]);
        }else{
            $vOrder->update(['is_shipped' => true]);
            $vOrder->user->notify(new OrderDelivery());
            return response(['result'=> true]);
        }
    }

    public function export() {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
