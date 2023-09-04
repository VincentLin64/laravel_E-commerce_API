@extends('layout.app')
@section('content')
<style>
    .spcial-text{
        text-align: center;
        background-color: green;
    }
</style>
<div class="row">
    <div class="col-4">
        <h2>商品列表</h2>
    </div>
    <div class="col-8">
        <img src="https://imgs.gvm.com.tw/upload/gallery/20221204/125075.jpg" alt="">
    </div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <td>標題</td>
            <td>內容</td>
            <td>單價</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                @if($product->id == 1)
                    <td class="spcial-text">{{$product->title}}</td>
                @else
                    <td>{{$product->title}}</td>
                @endif

                <td>{{$product->content}}</td>
                <td style="{{ $product->price < 200 ? 'color : red; font-size:22px' : ''}}"><i class="fa-solid fa-dollar-sign"></i>{{$product->price}}</td>
                <td><button class="btn btn-primary check_product" type="button" id="{{$product->id}}">確認商品數量</button></td>
                <td><button class="btn btn-warning check_shared_url" type="button" id="{{$product->id}}">分享商品</button></td>
            </tr>
        @endforeach

    </tbody>
</table>
<div id="app">
    <example-component></example-component>
</div>
<script>
    $(document).on('click', '.check_product', function () {
        let product_id = $(this).attr("id");
        $.ajax({
            method: 'POST',
            url: '/products/check-product',
            data: {
                'product_id': product_id
            }
        }).done(function (res) {
            if (res){
                alert('商品數量充足');
            } else{
                alert('商品數量不夠');
            }
        })
    })

    $(document).on('click', '.check_shared_url', function () {
        let product_id = $(this).attr("id");
        $.ajax({
            method: 'GET',
            url: `products/${product_id}/shared-url`,
        }).done(function (res) {
            alert(`請分享此縮網址：${res.url}`);
        })
    })
</script>
@endsection
