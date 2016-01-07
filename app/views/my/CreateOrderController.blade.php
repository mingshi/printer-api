@extends('layouts.master')
<?php $uri = '/1.0/my/create/order' ?>
<h2>接口名称: 下单</h2>
@section('content')
<div>
    <input type="text" name="user_id" value="9"/>
    <label class="color">user_id int</label><br>
</div>
<div>
    <input type="text" name="album_id" value="9"/>
    <label class="color">album_id int</label><br>
</div>
<div>
    <input type="text" name="quantity" value="4"/>
    <label class="color">quantity int</label><br>
</div>
<div>
    <input type="text" name="real_name" value="4"/>
    <label class="color">real_name string</label><br>
</div>
<div>
    <input type="text" name="mobile" value="13472688824"/>
    <label class="color">mobile string</label><br>
</div>
<div>
    <input type="text" name="address" value="上海市"/>
    <label class="color">address string</label><br>
</div>
@stop
