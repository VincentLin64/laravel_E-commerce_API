@extends('layout.app')
@section('content')

<div class="row">
    <div class="col">
        <h2 class="text-center">商品列表</h2>
    </div>
</div>

<table class="table table-striped table-hover">
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
                <td><a href="/products/{{$product->id}}">{{$product->title}}</a></td>

                <td>{{$product->content}}</td>
                <td><i class="fa-solid fa-dollar-sign"></i>{{$product->price}}</td>
                <td>
                    <button class="btn btn-primary check_product" type="button" id="{{$product->id}}">
                        <span class="spinner-border spinner-border-sm" id="loading_check_product_{{$product->id}}" role="status" aria-hidden="true" style="display: none"></span>確認商品數量
                    </button>
                </td>
                <td>
                    <button class="btn btn-warning check_shared_url" type="button" id="{{$product->id}}">
                        <span class="spinner-border spinner-border-sm" id="share_product_{{$product->id}}" role="status" aria-hidden="true" style="display: none"></span>
                        分享商品
                    </button>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
<script>
    $(document).on('click', '.check_product', function () {
        let product = $(this);
        product.attr('disabled', 'disabled');
        let product_id = $(this).attr("id");
        $(`#loading_check_product_${product_id}`).show();
        $.ajax({
            method: 'POST',
            url: '/products/check-product',
            data: {
                'product_id': product_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function (res) {
            product.attr('disabled', false);
            $(`#loading_check_product_${product_id}`).hide();
            if (res){
                alert('商品數量充足');
            } else{
                alert('商品數量不夠');
            }
        })
    })

    $(document).on('click', '.check_shared_url', function () {
        let product = $(this);
        product.attr('disabled', 'disabled');
        let product_id = $(this).attr("id");
        $(`#share_product_${product_id}`).show();
        $.ajax({
            method: 'GET',
            url: `products/${product_id}/shared-url`,
        }).done(function (res) {
            product.attr('disabled', false);
            $(`#share_product_${product_id}`).hide();
            alert(`請分享此縮網址：${res.url}`);
        })
    })
</script>
@endsection
