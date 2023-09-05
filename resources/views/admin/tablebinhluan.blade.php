<?php
$data1 = DB::table("tbl_loaitin")->select('id','ten')
->get();
?>



@extends('admin.layoutadmin')
@section('noidung')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font">Comment</h1>
<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="err1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->


</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Comment</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Id</th>
                        <th>Nội dung</th>

                        <th>ID sản phẩm</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    @foreach($data  as $dt)
                    <tr>
                        <td>{{$dt->id}}</td>
                        <td>{{$dt->noidung}}</td>
                        <td>{{$dt->idnew}}</td>

                        <td>
                        <form action="{{route('admin.binhluan.edit',['id'=>$dt->id])}}" method="post">
                            @csrf
                                <button>{{$dt->tinhtrang}}</button>
                            </form>
                        </td>
                    @endforeach


                </tbody>
            </table>
            <div class="pagination">
    {{ $data->links('pagination::simple-bootstrap-4') }}
</div>

        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<style>
    .btn button{
        width: 50px;
        background-color:red;
        color:white;
        border:none;
    }
    form button{
        background-color:red;
        color:white;
        border:none;
    }
    .font{
        font-weight: bold;
    }
</style>
<!-- End of Main C
@endsection
