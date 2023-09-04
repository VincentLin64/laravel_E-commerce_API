@extends('layout.admin_app')
@section('content')

<h2>後台 - 訂單列表</h2>
@php
//use Illuminate\Support\Facades\DB;
@endphp
{{--{{DB::enableQueryLog()}}--}}
<span>訂單總數 {{ $orderCount }}</span>
<div>
    <a class="btn btn-info btn-icon-split" href="/admin/orders/excel/export">匯出訂單</a>
    <a class="btn btn-info btn-icon-split" href="/admin/orders/excel/export-by-shipped">匯出分類訂單</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <td>購買時間</td>
            <td>購買者</td>
            <td>商品清單</td>
            <td>訂單總額</td>
            <td>是否運送</td>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->user->name }}</td>
            @foreach($order->orderItems as $orderItem)
                <td>{{ $orderItem->product->title }}</td> &nbsp;
            @endforeach

            <td>{{ isset($order->orderItems) ? $order->orderItems->sum('price') : 0 }}</td>
            <td>{{ $order->is_shipped }}</td>
        </tr>
    @endforeach

    </tbody>
</table>
<div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @for($i = 1; $i < $orderPages; $i++)
                <li class="page-item"><a class="page-link" href="/admin/orders?page={{ $i }}">{{ $i }}</a></li>
            @endfor
        </ul>
    </nav>
</div>
{{--{{dd(DB::getQueryLog())}}--}}
@endsection
