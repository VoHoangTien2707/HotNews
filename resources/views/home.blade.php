<?php
$data3 = DB::table("tbl_tin")->select('id','tieude','tomtat','img','ngaydang')
->orderby('ngaydang','desc')

->limit(6)->get();
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
@extends('layout')
@section('noidung0')
<div class="row ml-0 mr-0">
            <div class="col-md-6 pr-0">
                <div class="card">
                    <img class="card-img" src="{{asset('images/left-img.jpg')}}" alt="">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center flex-column">
                        <p>Spirituality</p>
                        <hr />
                        <h2>HOT NEWS</h2>
                        <a href="article.html" class="btn">READ MORE</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="card">
                    <img class="card-img" src="{{asset('images/right-img.jpg')}}" alt="">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center flex-column">
                        <p>DECOR</p>
                        <hr />
                        <h2>RECIDENT NEWS</h2>
                        <a href="article.html" class="btn">READ MORE</a>
                    </div>
                </div>
            </div>
             @foreach($data1 as $dt)
            <div class="col-md-3 pr-0 first">
                <a href="{{ url('/cat',[$dt->id]) }}">
                <div class="card">
                    <img class="card-img" src=" {{asset('images/food.png')}} " alt="">
                    <div class="card-img-overlay">
                        <h5>{{$dt->ten}}</h5>
                    </div>
                </div>
                </a>

            </div>
           @endforeach
            <!-- <div class="col-md-3 pl-0 pr-0">
                <div class="card">
                    <img class="card-img" src="{{asset('images/interior.png')}}" alt="">
                    <div class="card-img-overlay">
                        <h5>Interior</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3 pl-0 pr-0">
                <div class="card">
                    <img class="card-img" src="{{asset('images/food.png')}}" alt="">
                    <div class="card-img-overlay">
                        <h5>Food</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3 pl-0 last">
                <div class="card">
                    <img class="card-img" src="{{asset('images/travel.png')}}" alt="">
                    <div class="card-img-overlay">
                        <h5>Travel</h5>
                    </div>
                </div>
            </div> -->
        </div>
@endsection
@section('noidung1')
<div class="container">
            <div class="screen embed-responsive embed-responsive-16by9">
                <iframe id="screen" src="https://www.youtube.com/embed/YE7VzlLtp-4" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>

            <div class="play-list">
                <div class="owl-carousel owl-carousel4 owl-theme">
                    <div>
                        <div class="card"> <img class="card-img link-img"
                                data-link="https://www.youtube.com/embed/ujPNSC4JllE" src="{{asset('images/play1.png')}}"
                                alt="">
                        </div>
                    </div>
                    <div>
                        <div class="card"> <img class="card-img link-img"
                                data-link="https://www.youtube.com/embed/rMT8CffVFMk" src="{{asset('images/play2.png')}}"
                                alt="">

                        </div>
                    </div>
                    <div>
                        <div class="card"> <img class="card-img link-img"
                                data-link="https://www.youtube.com/embed/bGC9f1Po6Q8" src="{{asset('images/play3.png')}}"
                                alt="">

                        </div>
                    </div>
                    <div>
                        <div class="card"> <img class="card-img link-img"
                                data-link="https://www.youtube.com/embed/yHk_sypSiXU" src="{{asset('images/play4.png')}}"
                                alt="">

                        </div>
                    </div>
                    <div>
                        <div class="card"> <img class="card-img link-img"
                                data-link="https://www.youtube.com/embed/7yoqm-kgKEk" src="{{asset('images/play5.png')}}"
                                alt="">

                        </div>
                    </div>
                </div>
            </div>
            <hr>
<br>

            <h2 class="text-uppercase text-center">Tin mới nhất</h2>
<br>
            <div class="row vr-gallery">
<br>
            @foreach($data as $dt1)
                <div class="col-md-8 mb-4">
                    <div class="row">
                        <div class="col-md-12 col-lg-7 pr-0 pd-md">
                        <img class="hinh1" src="{{ asset('images/' . $dt1->img) }}" alt="">
                        </div>
                        <div class="col-md-12 col-lg-5 light-bg cus-pd cus-arrow-left">
                            <p><small>{{$dt1->ngaydang}}</small></p>
                            <a href="{{ url('/tin',[$dt1->id]) }}">                            <h3>{{$dt1->tieude}}</h3>
</a>
                            <p>
                            {{$dt1->tomtat}}
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 pl-4 mb-4">
                    <div class="card">
                        <img class="card-img h-100" src="{{asset('images/video-cover2.jpg')}}" alt="">
                        <div class="card-img-overlay opacity text-center">
                            <a class="play-1" href="https://www.youtube.com/watch?v=vpO8sZDxOGI"><img
                                    src="assets/images/play-icon.png" alt=""></a>
                            <h5 class="card-title">Weekend In Boston</h5>

                        </div>
                    </div>
                </div>
                @endforeach






                <div class="col-md-12 text-center">
                    <a href="#" class="btn">LOAD MORE</a>

                </div>
            </div>

        </div>
@endsection

@section('noidung2')
<div class="container">
            <div class="row">
                <div class="col-lg-12 pr-5">
                <h2 class="text-uppercase text-center">Tin nhiều người quan tâm</h2>
        <hr class="mx-auto" />
                    <div class="row">
                        @foreach($data3 as $dt2)
                        <div class="col-md-4">
                            <img class="hinh2" src=" {{ asset('images/' . $dt2->img) }} " class="w-100" alt="">
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
                                    <a class="nav-link" href="#">{{$dt2->ngaydang}}</a>
                                </li>
                                <li><span>.</span></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">12 Comments</a>
                                </li>


                            </ul>
                            <p class="second-clr text-center">{{$dt2->tomtat}}</p>

                            <a href="{{ url('/tin',[$dt2->id]) }}" class="btn read text-uppercase text-center mx-auto">Read More</a>

                        </div>
                        @endforeach









                    </div>


                    <div id="row" class="row">
                    <h2 class="text-uppercase text-center"> Tin tức danh mục</h2>

                    @foreach($data1 as $category)
    <div class="col-md-3">
        <img class="hinh3" src="{{ asset('images/banner-news.png') }}" class="w-100" alt="">
        <h3 class="text-center">{{ $category->ten }}</h3>
        <ul class="nav nav-fill mx-auto pb-3">
            @foreach($loctinByCategory[$category->id] as $news)
                <li class="bn nav-item">
                    <a id="a" class="nav-link" href="{{ url('/tin',[$news->id]) }}">{{ $news->tieude }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach









                    </div>


@endsection
<style>
    .hinh1{
        height:350px;    }

        .hinh2{
            height:230px;
            width: 360px;
        }
        .hinh3{
            height:160px;
            width: 100%;
        }
        #row{
            margin-top:70px;
        }
       .bn #a{
            text-align:left;
        }
        a.read{
            margin-bottom:20px;
        }
</style>
