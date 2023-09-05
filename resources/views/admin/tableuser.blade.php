<?php
$data1 = DB::table("tbl_loaitin")->select('id','ten')
->get();
?>



@extends('admin.layoutadmin')
@section('noidung')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 font">News</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="err1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
      <form action="/admin/tableuser/them" method="post" enctype="multipart/form-data" class="col-7 m-auto">
<p> Tên <input name="name" class="form-control"></p>
<p> Gmail <input name="email" class="form-control"></p>

<p> Image<input type="file"  class="form-control" name="img">
</p>
<p> Password <input name="password" class="form-control"></p>

<p> Role
<select name="role" required class="form-control">
       <option value="User">User</option>
       <option value="Admin">User</option>
       <option value="Tác giả">Tác giả</option>



                    </select>
</p>
@csrf
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
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
                        <th>Name</th>
                        <th>Gmail</th>

                        <th>Image</th>
                        <th class="pass">Password</th>
                        <th>Role</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    @foreach($data  as $dt)
                    <tr>
                        <td>{{$dt->id}}</td>
                        <td>{{$dt->name}}</td>
                        <td>{{$dt->email}}</td>
                        <td>
                        <img src="{{asset('images/'.$dt->img) }}" alt="Hình ảnh" width="100">
                        </td>
                        <td class="pass">{{$dt->password}}</td>
                        <td>{{$dt->role}}</td>

                        <td><a class="btn" href="{{route('admin.tableuser.edit',['id'=>$dt->id])}}"><button>Edit</button></a>
                        <a class="btn" href="{{route('admin.tableuser.delete',['id'=>$dt->id])}}"><button>Del</button></a></td>
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
    .pass {
    max-width: 100px; /* Điều chỉnh độ rộng tối đa của cột Password */
    overflow: hidden; /* Ẩn nội dung vượt quá độ rộng đã định */
    text-overflow: ellipsis; /* Hiển thị dấu ba chấm khi nội dung bị ẩn */
    white-space: nowrap; /* Ngăn cách thay đổi dòng */
}
</style>
<!-- End of Main C
@endsection
