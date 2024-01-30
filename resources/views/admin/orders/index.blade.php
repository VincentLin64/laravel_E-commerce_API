@extends('layout.admin_app')
@section('content')

<h2>後台 - 訂單列表</h2>
@php
//use Illuminate\Support\Facades\DB;
$iRouteOrderId = request()->route('order_id') ?? 0;
@endphp
{{--{{DB::enableQueryLog()}}--}}
<span>訂單總數 {{ count($orders) }}</span>
<div>
    @if($iRouteOrderId)
        <a class="btn btn-info btn-icon-split" href="/admin/orders/{{ $iRouteOrderId }}/excel/export/">匯出訂單</a>
    @else
        <a class="btn btn-info btn-icon-split" href="/admin/orders/excel/export">匯出訂單</a>
    @endif

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
    @forelse($orders as $order)
        <tr>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->user->name }}</td>
            <td>
            @foreach($order->orderItems as $orderItem)

                {{ $orderItem->product->title }} * {{$orderItem->quantity}} <span>({{$orderItem->product->price * $orderItem->quantity}} 元)</span><br>
            @endforeach
            </td> &nbsp;

            <td>{{ isset($order->orderItems) ? $order->orderItems->sum('price') : 0 }}</td>
            <td>{{ $order->is_shipped }}</td>
        </tr>
    @empty
        <tr>
            <td class="table-warning" colspan="5" style="text-align: center">無訂單資料</td>
        </tr>
    @endforelse

    </tbody>
</table>
<div>
    {!! $orders->links('pagination.custom') !!}
</div>
{{--{{dd(DB::getQueryLog())}}--}}
@endsection
