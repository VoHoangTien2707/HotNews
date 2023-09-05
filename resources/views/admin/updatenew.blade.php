<?php
$data1 = DB::table("tbl_loaitin")->select('id','ten')
->get();
?>

@extends('admin.layoutadmin')
@section('noidung')
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >
<form action="{{route('admin.table.edit',['id'=>$tin->id])}}" method="post" class="col-7 cla m-auto" enctype="multipart/form-data">
<p> Title <input name="tieude" value="{{$tin->tieude}}" class="form-control"></p>
<p> Summary <textarea name="tomtat" value="{{$tin->tomtat}}" class="form-control">{{$tin->tomtat}}</textarea></p>
<p> Description                                                                                                                                                                                                                                                                                                                        <textarea name="noidung" value="{{$tin->noidung}}" class="form-control">{{$tin->noidung}}</textarea></p>

<input type="file" name="img" id="image" class="form-control-file">
            @if (isset($tin) && $tin->img)
                <img src="{{ asset('images/' . $tin->img) }}" alt="Hình ảnh" width="100">
            @endif<p> ID Category
                <select name="idlt" required class="form-control">
        @foreach($data1 as $pv)
            <option value="{{$pv->id}}">{{$pv->ten}}</option>
        @endforeach

                    </select>
</p>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="err1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
