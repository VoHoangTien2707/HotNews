<?php
$data1 = DB::table("tbl_loaitin")->select('id','ten')
->get();
?>

@extends('admin.layoutadmin');
@section('noidung')
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >
<form action="{{route('admin.tabledm.edit',['id'=>$tin->id])}}" method="post" class="col-7 cla m-auto" enctype="multipart/form-data">
<p> Categories Name <input name="ten" value="{{$tin->ten}}" class="form-control"></p>
<p> View <input name="hienthi" value="{{$tin->hienthi}}" class="form-control"></p>

<p><button class="button bg-warning" type="submit" class="bg-warning p-2">Thêm tin</button></p>
@csrf
</form>
@endsection
<style>
    .button{
        border:none;
        border-radius:10px;
                width:110px;
                height:40px;
                color:white;
                font-weight: bold;

    }
    .cla p{
        font-weight: bold;

    }
</style>
