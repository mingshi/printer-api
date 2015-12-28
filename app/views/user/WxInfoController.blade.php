@extends('layouts.master')
<?php $uri = '/1.0/user/wx/info' ?>
<h2>接口名称: 用户信息</h2>
@section('content')
<div>
    <input type="text" name="wx_id" value="1111"/>
    <label class="color">wx_id string</label><br>
</div>
@stop
