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
                <td></td>
            </tr>
        @endforeach

    </tbody>
</table>
