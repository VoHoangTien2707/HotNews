<?php
$data1 = DB::table("tbl_loaitin")->select('id','ten')
->get();
?>



<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >
<form action="{{route('admin.tableuser.edit',['id'=>$tin->id])}}" method="post" class="col-7 cla m-auto" enctype="multipart/form-data">
<p> Name <input name="name" value="{{$tin->name}}" class="form-control"></p>
<p> Description <input name="description" value="{{$tin->description}}" class="form-control"></p>
<p> Price <input name="price" value="{{$tin->price}}" class="form-control"></p>

<p> Image <input type="file" name="img" id="image" class="form-control-file">

<p><button class="button bg-warning" type="submit" class="bg-warning p-2">Edit User</button></p>
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
