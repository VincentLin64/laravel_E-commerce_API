@extends('layout.app')
@section('content')
<h3>聯絡我們</h3>
<form action="">
    <div class="form-group mb-3">
        <label for="name" class="form-label">請問你是：</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
{{--        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">請問你的消費時間：</label>
        <input type="date" class="form-control" id="name" name="date" aria-describedby="emailHelp">
        {{--        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
    </div>
    <div class="mb-3">
        <label for="product" class="form-label">你消費的商品種類：</label>
        <select id="product" name="product" class="form-select">
            <option value="物品">物品</option>
            <option value="食物">食物</option>
        </select>
    </div>
    <input type="submit" value="送出">
</form>

@endsection
