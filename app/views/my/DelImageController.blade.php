@extends('layouts.master')
<?php $uri = '/1.0/my/del/image' ?>
<h2>接口名称: 删除图片</h2>
@section('content')
<div>
    <input type="text" name="user_id" value="9"/>
    <label class="color">user_id int</label><br>
</div>
<div>
    <input type="text" name="ids" value="9,10"/>
    <label class="color">ids string</label><br>
</div>
@stop
