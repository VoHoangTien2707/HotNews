
<?php
$data1 = DB::table("tbl_loaitin")->select('id','ten')
->get();
?>



@extends('tacgia.layouttacgia')
@section('noidung')
<div class="container-fluid">





<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font">News</h1>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add News
</button>


@if(session()->has('thongbao') && session('thongbao') != '')

    <div id="thongbao" class="alert alert-success" role="alert">
    <h6 >{{ session('thongbao') }}</h6></div>
    <script>
        setTimeout(function() {
            document.getElementById('thongbao').style.display = 'none';
        }, 5000); // 15 giây
    </script>
@endif
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{route('tacgia.add',$tin->id)}}" method="post" enctype="multipart/form-data" class="col-7 m-auto">
<p> Title <input name="tieude" class="form-control"></p>
<p> Summary <textarea name="tomtat" class="form-control"></textarea></p>

<p> Image<input type="file"  class="form-control" name="img">
</p>
<p> ID Category
<select name="idlt" required class="form-control">
        @foreach($data1 as $pv)
            <option value="{{$pv->id}}">{{$pv->ten}}</option>
        @endforeach



                    </select>
</p>
@csrf
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="err1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif  
      </form>
    </div>
  </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">NEWS</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Id</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    @foreach($data  as $dt)
                    <tr>
                        <td>{{$dt->id}}</td>
                        <td>{{$dt->tieude}}</td>
                        <td>{{$dt->tomtat}}</td>
                        <td>
                        <img src="{{asset('images/'.$dt->img) }}" alt="Hình ảnh" width="100">
                        </td>
                        <td><a class="btn" href="{{route('tacgia.table.edit',['id'=>$dt->id])}}"><button>Edit</button></a>
                        <a class="btn" href="{{route('tacgia.table.delete',['id'=>$dt->id])}}"><button>Del</button></a></td>
                    </tr>
                    @endforeach



                </tbody>
            </table>


        </div>
    </div>
    <div class="pagination">
    {{ $data->links('pagination::simple-bootstrap-4') }}
</div>
</div>
@endsection


</div>
<!-- /.container-fluid -->

</div>
<style>
    .pagination{
        margin: 0 auto;
    display: none;
}
    .btn button{
        width: 50px;
        background-color:red;
        color:white;
        border:none;
    }
    .font{
        font-weight: bold;
    }
    .div{
        display:flex;
        margin:0 auto;

    }
    .text-gray-700 {
    color: white !important;
    margin-top:19px;
    text-align:center;
}
    .div .input{
        width: 300px;
        margin-left:200px;
        border:1px solid  black;
        height:50px;
        border-radius:10px;
    }
    .div button{
        height:50px;
    }
    .div{
        margin-bottom:20px;
    }
    svg {
    overflow: hidden;
    vertical-align: middle;
    width: 10px;
}
::after, ::before {
    box-sizing: border-box;
    margin: 5px;
}
</style>

<!-- End of Main C


