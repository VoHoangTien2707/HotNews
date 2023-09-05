
<?php
$data3 = DB::table("tbl_tin")->select('id','tieude','tomtat','img','ngaydang')
->orderby('ngaydang','desc')

->limit(3)->get();
?>
<!doctype html>
<html lang="en">

<head>
    <!--
    /   Shahala: Free Template by FreeHTML5.co
    /   Author: https://freehtml5.co
    /   Facebook: https://facebook.com/fh5co
    /   Twitter: https://twitter.com/fh5co
    -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
     <style>

     </style>
    <title>HotNews</title>
</head>

<body>
    <header class="mt-0 pt-0">
        <div class="bg-cover clearfix pt-3">
            <h2 class="logo">HotNews</h2>
            <nav class="nav nav-fill mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="https://facebook.com/fh5co" target="_blank"><i
                            class="fab fa-facebook-f"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://twitter.com/fh5co" target="_blank"><i
                            class="fab fa-twitter"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fab fa-instagram"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fab fa-google-plus-g"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-rss"></i></a>
                </li>
            </nav>


            <input type="text" id="nav-search" class="nav-search mx-auto" name="" class="form-control">
            <div class="ml-0 mr-0 pb-1">
                <nav class="navbar navbar-expand-md">

                    <button class="navbar-toggler ml-auto" data-target="#my-nav" data-toggle="collapse"
                        aria-controls="my-nav" aria-expanded="false" onclick="myFunction(this)"
                        aria-label="Toggle navigation">
                        <span class="bar1"></span> <span class="bar2"></span> <span class="bar3"></span>
                    </button>
                    <div id="my-nav" class="collapse navbar-collapse">
                        <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                        <i class="fa-regular fa-house"></i>                                <a class="nav-link" href="{{route('trangchu')}}">HOME</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Danh mục
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          @foreach($data1 as $dt)
            <li><a class="dropdown-item" href="{{ url('/cat',[$dt->id]) }}">{{$dt->ten}}</a></li>
@endforeach
          </ul>
                            </li>

                            @foreach($data1 as $dt)
            <li class="nav-item"><a class="nav-link" href="{{ url('/cat',[$dt->id]) }}">{{$dt->ten}}</a></li>
@endforeach

                            <li class="nav-item">
@if (session()->has('user'))
    @php $user = session('user'); @endphp
    <li class="nav-item">

    <a class="nav-link nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Xin chào: {{$user->name}}</a>
    <ul class="dropdown-menu" id="menu" aria-labelledby="navbarDropdown">

    <li><a class="dropdown-item" href="{{ url('/profile', $user->id) }}">Thông tin cá nhân</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>

          </ul>
</li>
@else
                                <a class="nav-link" href="{{ url('/dangnhap') }}">ĐĂNG NHẬP</a>
@endif
                            </li>
                            <li class="nav-item">
                                <form action="">
                                <div class="box">
  <div class="container-1">





  </div>
</div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        @yield('noidung0')

    </header>

    <div class="container-fluid video-player">

        @yield('noidung1')
    </div>



    <div class="container-fluid ar-content mt-4">

    @yield('noidung2')

                </div>
    <div class="container-fluid jumbotron-fluid stay mt-5 pt-5 pb-5">
        <h2 class="text-center">Stay Updated</h2>
        <p class="text-center mt-2">Sign up for our newsletter to receive the latest news and event postings.</p>
        <div class="input-group mt-4 mx-auto" style="max-width: 640px">
            <input type="email" class="form-control" placeholder="YOUR EMAIL ADDRESS">
            <div class="">
                <button class="btn btn-success ml-2" type="submit">SIGN UP</button>
            </div>
        </div>
    </div>

    <footer class="container-fluid pt-5">
        <div class="container">
            <h2 class="logo text-center">HotNews</h2>
            <nav class="nav nav-fill mx-auto mt-5">
                <li class="nav-item">
                    <a class="nav-link" href="https://facebook.com/fh5co" target="_blank"><i
                            class="fab fa-facebook-f"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://facebook.com/fh5co" target="_blank"><i
                            class="fab fa-twitter"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fab fa-instagram"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fab fa-google-plus-g"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-rss"></i></a>
                </li>
            </nav>
        </div>

    </footer>



</body>
<style>

    .play-list .card{
        opacity: 1
        ;
        width: 30%;
        margin-left:30px;
    }
    .play-list .card{
        display:flex;

    }
    .dropdown-menu{
        margin-left:27%;
    }
    #menu{
        margin-left:64%;
    }
</style>
</html>
<script src="{{asset('js/main.js')}"></script>

