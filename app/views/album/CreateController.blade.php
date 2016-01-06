@extends('layouts.master')
<?php $uri = '/1.0/album/create' ?>
<h2>接口名称: 创建相册</h2>
@section('content')
<div>
    <input type="text" name="user_id" value="4"/>
    <label class="color">user_id int</label><br>
</div>
<div>
    <input type="text" name="class_id" value="4"/>
    <label class="color">class_id int</label><br>
</div>
@stop
