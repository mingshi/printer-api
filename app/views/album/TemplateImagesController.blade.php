@extends('layouts.master')
<?php $uri = '/1.0/album/template/images' ?>
<h2>接口名称: 模板图片列表</h2>
@section('content')
<div>
    <input type="text" name="template_id" value="4"/>
    <label class="color">template_id int</label><br>
</div>
@stop
