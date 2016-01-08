@extends('layouts.master')
<?php $uri = '/1.0/pay/callback' ?>
<h2>接口名称: 创建支付订单</h2>
@section('content')
<div>
    <input type="text" name="out_trade_no" value="4"/>
    <label class="color">out_trade_no string</label><br>
</div>
@stop
