@extends('layouts.master')
<?php $uri = '/1.0/my/album/list' ?>
<h2>接口名称: 相册列表</h2>
@section('content')
<div>
    <input type="text" name="user_id" value="4"/>
    <label class="color">user_id int</label><br>
</div>
@stop
