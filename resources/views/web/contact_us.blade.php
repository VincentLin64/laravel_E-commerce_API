@extends('layout.app')
@section('content')
<h3>聯絡我們</h3>
<form action="">
    請問你是： <input type="text" name="name"> <br>
    請問你的消費時間： <input type="date" name="date"> <br>
    你消費的商品種類：
    <select name="product">
        <option value="物品">物品</option>
        <option value="食物">食物</option>
    </select>
    <br>
    <input type="submit" value="送出">
</form>

@endsection
