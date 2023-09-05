<?php
$data1 = DB::table("tbl_loaitin")->select('id','ten')
->get();
?>



@extends('admin.layoutadmin')
@section('noidung')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font">News</h1>

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
                        <th>Tổng đơn hàng</th>

                        <th>Name</th>
                        <th>Điện thoại</th>
                        <th>ID New</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    @foreach($data  as $dt)
                    <tr>
                        <td>{{$dt->id}}</td>
                        <td>{{$dt->tongdonhang}}</td>
                        <td>{{$dt->name}}</td>
                        <td>{{$dt->dienthoai}}</td>
                        <td>{{$dt->idnew}}</td>
                        <td>
                        <a class="btn" href="{{route('admin.tableorder.delete',['id'=>$dt->id])}}"><button>Del</button></a></td>
                    </tr>
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
    .font{
        font-weight: bold;
    }
</style>
<!-- End of Main C
@endsection
