@extends('layouts.master')
<?php $uri = '/1.0/pay/create' ?>
<h2>接口名称: 创建支付订单</h2>
@section('content')
<div>
    <input type="text" name="order_id" value="4"/>
    <label class="color">order_id int</label><br>
</div>
<div>
    <input type="text" name="user_id" value="4"/>
    <label class="color">user_id int</label><br>
</div>
<div>
    <input type="text" name="open_id" value="4"/>
    <label class="color">open_id string</label><br>
</div>
@stop
