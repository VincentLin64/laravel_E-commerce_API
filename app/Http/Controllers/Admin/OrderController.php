<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Exports\OrdersExport;
use App\Exports\OrdersMultipleExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\OrderDelivery;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    //
    public function index(Request $request) {
        $dataPerPage = 5;
        $iGetOrderId = $request->route('order_id');
        $iPage = $request->input('page', 1);
        if ($iGetOrderId) {
            $orderCounts = Order::findOrFail($iGetOrderId)->whereHas('orderItems')->count();
        } else {
            $orderCounts = Order::whereHas('orderItems')->count();
        }
        $vOrders = Order::orderBy('created_at', 'desc')
            ->with(['user', 'orderItems.product', 'cart.cartItems'])
            ->whereHas('orderItems')
            ->paginate(5);
//        $orderPages = ceil($orderCounts / $dataPerPage) + 1;

        $vReturnData = ['orders' => $vOrders, 'orderCount' => $orderCounts];
        return view('admin.orders.index', $vReturnData);
    }

    public function delivery($id){
        $vOrder = Order::find($id);
        if (empty($vOrder)) {
            return response(['result' => '訂單不存在'], 404);
        } else if ($vOrder->is_shipped) {
            return response(['result' => false]);
        } else {
            $vOrder->update(['is_shipped' => true]);
            $vOrder->user->notify(new OrderDelivery());
            return response(['result' => true]);
        }
    }

    public function export() {
        $iGetOrderId = \request()->route('order_id');
        return Excel::download(new OrdersExport($iGetOrderId), 'orders.xlsx');
    }
    public function exportByShipped() {
        return Excel::download(new OrdersMultipleExport, 'orders_by_shipped.xlsx');
    }

    public function datatable(OrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.datatables');
    }
}
