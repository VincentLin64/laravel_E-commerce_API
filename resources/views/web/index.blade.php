<head>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<style>
    .spcial-text{
        text-align: center;
        background-color: green;
    }
</style>
<div>
    <a style="margin-top: 40px" href="/">商品列表</a>
    <a href="/contact_us">聯絡我們</a>
</div>
<h2>商品列表</h2>
<img src="https://imgs.gvm.com.tw/upload/gallery/20221204/125075.jpg" alt="">
<table>
    <thead>
        <tr>
            <td>標題</td>
            <td>內容</td>
            <td>單價</td>
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
                <td style="{{ $product->price < 200 ? 'color : red; font-size:22px' : ''}}">{{$product->price}}</td>
                <td><button class="check_product" type="button" id="{{$product->id}}">確認商品數量</button></td>
            </tr>
        @endforeach

    </tbody>
</table>
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
</script>
