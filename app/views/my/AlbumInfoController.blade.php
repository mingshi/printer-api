@extends('layouts.master')
<?php $uri = '/1.0/my/album/info' ?>
<h2>接口名称: 相册详情</h2>
@section('content')
<div>
    <input type="text" name="user_id" value="4"/>
    <label class="color">user_id int</label><br>
</div>
<div>
    <input type="text" name="album_id" value="4"/>
    <label class="color">album_id int</label><br>
</div>
@stop
