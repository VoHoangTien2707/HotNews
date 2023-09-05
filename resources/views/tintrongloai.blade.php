<!-- @foreach($listtin as $t)
<div>
    <a href="{{ url('/tin',[$t->id])}}"><h3>{{$t->tieude}}</h3></a>
    <h6>{{$t->tomtat}}</h6>
</div>
@endforeach -->
<?php
$data1 = DB::table("tbl_loaitin")->select('id','ten')

->get();
?>

@extends('layout')
@section('noidung1')
<div class="container-fluid ar-content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pr-5">
                <h2 class="text-uppercase text-center">News</h2>

                <div class="search">
                <form action="{{ route('products.search') }}" method="GET">
    <span class="icon"><i class="fa fa-search"></i></span>
      <input type="search" name="keyword" id="search" placeholder="Search..." />
      <input type="submit" value="Search" id="tikiem" name="timkiem" class="sidebar-search-btn">
    </form>
    <form action="{{ route('products.search_by_time') }}" method="GET">
    <select name="days">
        <option value="1">1 ngày</option>
        <option value="3">3 ngày</option>
        <option value="7">7 ngày</option>
        <option value="30">30 ngày</option>
    </select>
    <button class="sub" type="submit">Tìm kiếm</button>
</form>
</div>


        <hr class="mx-auto" />
                    <div class="row">

                    @if(count($listtin) > 0)



                        @foreach($listtin as $dt2)
                        <div class="col-md-4">
                            <img src="{{asset('images/'.$dt2->img) }}" class="w-100 hinh2" alt="">
                            <p class="img-tag text-center">LIFESTYLE</p>
                            <hr class="mt-0" />
                            <a href="{{ url('/tin',[$dt2->id]) }}">
                            <h3 class="text-center">{{$dt2->tieude}}</h3>
                            </a>


                            <ul class="nav nav-fill mx-auto pb-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">By John Doe</a>
                                </li>
                                <li><span>.</span></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">10 Oct 2016</a>
                                </li>
                                <li><span>.</span></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">12 Comments</a>
                                </li>


                            </ul>
                            <p class="second-clr text-center">{{$dt2->tomtat}}</p>

                            <a href="#" class="btn text-uppercase text-center mx-auto">Read More</a>

                        </div>
                        @endforeach



                        @else
<h2>Không có sản phẩm phù hợp</h2></h2>
@endif





                    </div>

                </div>
@endsection
<style>
    .hinh2{
        width: 360px;
        height:230px;
    }
    .search{
        display:flex;
        margin-left:20px;
        margin-top:10px;
    }
    .search button{
        background-color:red;
        color:white;
        border:none;
        margin-right:20px;
    }
    .search select{
        width: 300px;
        height:40px;
        margin-left:40px;
    }
    #search{
        width: 300px;
        height:40px;
    }
    button.sub{
        background-color:black;
        color:white;
        height:40px;

    }
    #tikiem{
        height:40px;
        background-color:black;
        color:white;
    }
</style>
