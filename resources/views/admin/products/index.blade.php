@extends('layout.admin_app')
@section('content')


<h2>後台 - 產品列表</h2>
@php
    //use Illuminate\Support\Facades\DB;
@endphp
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{--{{DB::enableQueryLog()}}--}}
<span>產品總數 {{ $productCount }}</span>
<div>
    <input type="button" class="import btn btn-primary btn-icon-split" value="匯入Excel" >
</div>
<table class="table table-striped">
    <thead>
    <tr>
        <td>編號</td>
        <td>標題</td>
        <td>內容</td>
        <td>價格</td>
        <td>數量</td>
        <td>圖片</td>
        <td>功能</td>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->title }}</td>
            <td>{{ $product->content }}</td> &nbsp;
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>
                @if(!empty($product->image_url))
                    <a class="btn btn-info btn-icon-split" href="{{$product->image_url}}" target="_blank" rel="noopener noreferrer">圖片連結</a>
                @endif
            </td>
            <td>
                <input type="button" class="upload_image btn btn-info btn-icon-split" data-id="{{$product->id}}"  value="上傳圖片">
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
<div>
    {!! $products->links('pagination.custom') !!}
</div>
@vite('resources/js/admin/admin.js')
<script>

</script>
@endsection
