@extends('layouts.master')
<?php $uri = '/1.0/user/info' ?>
<h2>接口名称: 用户信息</h2>
@section('content')
<div>
    <input type="text" name="user_id" value="9"/>
    <label class="color">user_id int</label><br>
</div>
@stop
