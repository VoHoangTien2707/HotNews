
<?php
$id = $data1->pluck('id')->toArray();
$ls = DB::table('tbl_LichSuXemTin')->where('idnew', $id)
->get();
?>


@extends('layout')

@section('noidung0')


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


@if($data1->isEmpty())
    <p class="aa">Bạn đã không xem tin tức nào</p>
@else
    @foreach($data1 as $dt)
    <div class="card mb-3" style="max-width: 80%;">

        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('images/'.$dt->img) }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8 mhg">
                <div class="card-body">
                    <a href="{{ url('/tin',[$dt->id]) }}">                    <h5 class="card-title">{{$dt->tieude}}</h5>
</a>
                    <p class="card-text">{{$dt->tomtat}}</p>
                    @foreach($ls as $item)
                        <p class="card-text"><small class="text-body-secondary">Ngày xem: {{$item->thoigianxem}}</small></p>
                    @endforeach
                </div>
            </div>
        </div>
        </div>

    @endforeach
    <div class="pagination">
</div>
@endif
</div>



</body>
</html>
@endsection
<style>
    .mbd{
        background-color:white;
        min-height:600px;
    }
    .aa{
        font-size:20px;
        color:red;
        margin-top:20px;
        font-style: italic;

    }
    .mhg{
        color:black;
        text-align:left;
    }
    .card{
        color:black;
        height:100px;
        margin:0 auto;
        margin-top:20px;
    }
    .img-fluid{
        width: 180px;
        padding-top:10px;
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

</style>
