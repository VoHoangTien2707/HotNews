

@extends('layout')

@section('noidung0')
<?php

$order = DB::table('tbl_donhang')
    ->select('id', 'idnew', 'iduser', 'ngaydat','ngayhethang')
    ->where('iduser', $tin->id)
    ->get();


    $currentDate = date('Y-m-d H:i:s');


?>
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
@if($order->isNotEmpty())

    <!-- Khi có thông tin đơn hàng của người dùng -->

    <a class="a" href="{{ route('tacgia', ['id' => $tin->id]) }}">

        <button>Kênh tác giả</button>

    </a>

@elseif($order->where('ngayhethang', $currentDate)->isNotEmpty())

    <!-- Khi có thông tin đơn hàng của người dùng và ngày hết hạn là ngày hiện tại -->

    <a class="aa" href="{{ route('ordergoi') }}">

        Gói của bạn đã hết hạn, vui lòng nhấn vào đây để đăng ký

    </a>

@else

    <!-- Khi không có thông tin đơn hàng của người dùng hoặc ngày hết hạn không phải ngày hiện tại -->

    <a class="aa" href="{{ route('ordergoi') }}">

        Bạn chưa đăng ký quyền tác giả, vui lòng nhấn vào đây để đăng ký

    </a>

@endif

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
    .a button{
        width: 250px;
        height:60px;
        background-color:red;
        color:white;
        margin-top:50px;
        border:none;
        font-size:20px;
    }
    .aa{
        margin-top:50px;
        font-style: italic;

    }
</style>
