@extends('layouts.master')
<?php $uri = '/1.0/album/image/info' ?>
<h2>接口名称: 模板图片列表</h2>
@section('content')
<div>
    <input type="text" name="image_id" value="4"/>
    <label class="color">image_id int</label><br>
</div>
@stop
