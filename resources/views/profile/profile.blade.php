@extends('layout')

@section('noidung0')

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"

        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet"  href="{{asset('css/style.css')}}">
    <link rel="stylesheet"  href="{{asset('css/bootstrap.min.css')}}">

    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{asset('js/jquery-1.12.0.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.yu2fvl.js')}}"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Xin chào: {{$tin->name}}</h3>
  <a href="{{route('profile',$tin->id)}}" class="w3-bar-item w3-button">Thông tin cá nhân</a>
  <a href="{{route('lichsuxemtin',$tin->id)}}" class="w3-bar-item w3-button">Tin đã xem</a>
  <a href="{{route('muahang',$tin->id)}}" class="w3-bar-item w3-button">Lịch sử mua hàng</a>
</div>

<!-- Page Content -->
<div style="margin-left:25%">

<div class="w3-container mbd">
<div class="card mb-8" style="max-width: 80%; min-height:500px; margin:0 auto;">
  <div class="row g-0">
  <div class="card-body col-md-8 text-body-secondary ">
        <h5 class="card-title">Profile for me</h5>
        <form action="{{route('profile.edit',['id'=>$tin->id])}}" enctype="multipart/form-data"  method="post">
            @csrf
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Gmail</label>
    <div class="col-sm-10">
      <input type="text"  class="" name="email" id="staticEmail" value="{{$tin->email}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-cntrol-" name="name" id="staticEmail" value="{{$tin->name}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Phone Number</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control-" name="dienthoai" id="staticEmail" value="{{$tin->dienthoai}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-label">Địa chỉ</label>
    <div class="col-sm-10">
      <input type="text" class="form--plaintext" name="diachi" id="staticEmail" value="{{$tin->diachi}}">
    </div>
  </div>
      </div>
    <div class="col-md-4 tang" id="tang">

      <img class="img" src="{{asset('images/'.$tin->img) }}" class="img-fluid rounded-start" alt="...">
      <input type="file" name="img" id="image" class="form-control-file">
    </div>
  </div>
  <button class="button" type="submit">Save</button>
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



</body>
</html>
@endsection
<style>
    .mbd{
        background-color:white;
        min-height:600px;
    }
    .card{
        color:black;
    }
    .button{
        width: 10%;
        background-color:red;
        border:none;
        color:white;
        margin:0 auto;
    }
  .col-md-4  .img{
        width:200px;
        border-radius:50%;
        padding:20px 10px;
    }
    #tang{
        margin-top:80px;
    }
    input{
        border-bottom:2px solid black;
        margin-left:0px;
        width: 80%;
    }
    #image{
        width: 40%;
        border:none;
        margin:0 auto;
    }
    .card-title{
        font-size:30px;
        padding:30px;
    }
    .w3-sidebar {
    position: absolute;
    z-index: 1;
}
</style>
