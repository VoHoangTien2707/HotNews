
<?php
$data1 = DB::table("tbl_loaitin")->select('id','ten')
->get();
?>



@extends('tacgia.layouttacgia')
@section('noidung')
<div class="container-fluid">





<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font">News</h1>




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
                        <th>Tiêu đề</th>
                        <th>Id New</th>
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
                        <td>{{$dt->idnew}}</td>
                        <td>
                        <form action="{{route('tacgia.binhluan.edit',['id'=>$dt->id])}}" method="post">
                            @csrf
                                <button>{{$dt->tinhtrang}}</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach



                </tbody>
            </table>


        </div>
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


