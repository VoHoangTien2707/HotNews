<?php
$idlt = $tin->idlt;
$idsp = $tin->id;
$listtin = DB::table('tbl_tin')->where('idlt', $idlt)
->where('id','!=',$idsp)
->get();
$tin1 = DB::table('tbl_tin')
->select('id','tieude','tomtat','noidung','luotxem','img','ngaydang')
->orderby('luotxem','desc')
->limit(4)
->get();

if (session()->has('user')){
    $user = session('user');
    $iduser = $user->id;
}
else{
    $iduser=0;
}
$com = DB::table('users')->where('id',$iduser)->first();

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet"  href="{{asset('css/style.css')}}">
    <link rel="stylesheet"  href="{{asset('css/bootstrap.min.css')}}">

    <title>Shahala</title>
</head>

<body class="article-pg">
    <header class="mt-0 pt-0">
        <div class="bg-cover clearfix pt-3">
            <h2 class="logo">Shahala</h2>
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
                                <a class="nav-link" href="{{ url('/')}}">NEWS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">HISTORY</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">CULTURE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">TECH</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">LIFE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">OPINION</a>
                            </li>
                            <li class="nav-item">
                            @if (session()->has('user'))
    @php $user = session('user'); @endphp
    <li class="nav-item">

    <a class="nav-link nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Xin chào: {{$user->name}}</a>
    <ul class="dropdown-menu" id="menu" aria-labelledby="navbarDropdown">

            <li><a class="dropdown-item" href="">Thông tin cá nhân</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>

          </ul>
</li>
@else
                                <a class="nav-link" href="{{ url('/dangnhap') }}">ĐĂNG NHẬP</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <ul class="nav nav-fill mx-auto breadc pb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/')}}">Home</a>
                </li>
                <li><img src="assets/images/star-shape.png" class="mt-2" alt=""></li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Article</a>
                </li>
            </ul>
        </div>



    </header>


<!-- Nút xóa tin tức khỏi mục yêu thích -->
    <div class="container-fluid ar-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 pr-5">
                    <div class="card ar-img-over">
                        <img class="card-img" src="{{ asset('images/' . $tin->img) }}" alt="">
                        <div class="card-img-overlay">
                            <a href="#" class="d-flex align-items-center justify-content-center"><img
                                    src="assets/images/full-screen.png" alt=""></a>
                        </div>
                    </div>
                    <div class="row date-time mt-3">

                        <div class="col text-white">
                            <a href="#"> <i class="fas fa-retweet"></i> Share</a>
                        </div>
                        <div class="col text-right"><a href="#"> June 3, 2019 &nbsp; 6 <i
                                    class="far fa-comments"></i></a></div>
                    </div>

                    <h2>{{$tin->tieude}}</h2>
                    <p>{{$tin->tomtat}}.</p>

                    <div class="media my-5">
                        <div class="q-box d-flex align-items-center justify-content-center"><img
                                src="{{asset('images/quote.png')}}" alt=""></div>
                        <div class="bbg media-body">
                            <h5 class="mb-0">{{$tin->tomtat}}.</h5>

                        </div>
                    </div>

                    <p>
                        {{$tin->noidung}} </p>


                    <h2 class="text-center fs-35 mt-5 pt-5 mb-0 pb-2">Bài Viết Tương Tự</h2>
                    <hr class="mt-0 pt-0" />


                    <div class="row">
                        @foreach($listtin as $tin1)
                        <div class="col-md-6">
                            <img src=" {{ asset('images/' . $tin1->img) }}" class="w-100" alt="">
                            <p class="img-tag text-center">LIFESTYLE</p>
                            <hr class="mt-0" />
                            <h3 class="text-center">{{$tin1->tieude}}</h3>

                            <ul class="nav nav-fill mx-auto pb-3">
                                <li class="nav-item">x`
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
                            <p class="second-clr text-center">{{$tin1->tomtat}}</p>

                            <a href="#" class="btn text-uppercase text-center mx-auto">Read More</a>

                        </div>
                        @endforeach

                    </div>
                    <div class="comment-section mt-5">
                        <h3>3 Comments</h3>
                        <hr class="ml-0" />
                        <div class="media pt-5">
                            <div class="card mr-4">
                                <img src="assets/images/comment-user1.png" alt="" class="card-img">
                                <div class="card-img-overlay">

                                </div>
                            </div>
@foreach($comment as $cmt)
                            <div class="media-body">
                                <div class="row">
                                    <div class="col text-left">
                                        <h4>{{$cmt->name}}</h4>
                                    </div>
                                    <div class="col text-right">
                                        <p class="my-0"><span>{{$cmt->ngaydang}}</span> <a href="#" class="ml-3">Reply</a>
                                        </p>
                                    </div>
                                </div>
                                <p>{{$cmt->noidung}}</p>


                            </div>
                            @endforeach

                        </div>



                        <div class="media py-5 bottom-border">
                            <div class="card mr-4">
                                <img src="assets/images/comment-user3.png" alt="" class="card-img">
                                <div class="card-img-overlay">

                                </div>
                            </div>


                        </div>


                    </div>
                    <div class="comment-form my-5 pt-5">
    <h3>Add Comments</h3>
    <hr class="ml-0" />
    <hr class="s-br" />
    <table class="table table-borderless mt-4">
        <form action="{{ route('comments.store') }}" method="post">
            @csrf


                <input type="hidden" name="idnew" value="{{ $idsp }}">


            <input type="hidden" name="iduser" value="{{ $iduser }}">

            <tr>
                <td colspan="3"><textarea class="form-control" name="noidung" placeholder="Your comment"></textarea></td>
            </tr>
            <tr>
                <td colspan="3"><button type="submit" class="btn text-uppercase ml-auto d-block">Add Comment</button></td>
            </tr>
        </form>
    </table>
</div>
</div>
                <div class="col-lg-3 pl-0">
                    <div class="sidebar">
                        <h3 class="text-center text-white">Top Authors</h3>
                        <hr class="bg-white" />

                        <div class="owl-carousel owl-carousel4 owl-theme">
                            <div>
                                <div class="card pb-5"> <img class="card-img link-img rounded"
                                        src="assets/images/carlla-willstons.jpg" alt="">
                                </div>
                                <h3 class="text-center mt-3 mb-0">Carlla Willstons</h3>
                                <p class="text-center mt-1 third-clr">Reporter</p>
                            </div>

                            <div>
                                <div class="card pb-5"> <img class="card-img link-img rounded"
                                        src="assets/images/carlla-willstons.jpg" alt="">
                                </div>
                                <h3 class="text-center mt-3 mb-0">Carlla Willstons</h3>
                                <p class="text-center mt-1 third-clr">Reporter</p>
                            </div>

                            <div>
                                <div class="card pb-5"> <img class="card-img link-img rounded"
                                        src="assets/images/carlla-willstons.jpg" alt="">
                                </div>
                                <h3 class="text-center mt-3 mb-0">Carlla Willstons</h3>
                                <p class="text-center mt-1 third-clr">Reporter</p>
                            </div>

                            <div>
                                <div class="card pb-5"> <img class="card-img link-img rounded"
                                        src="assets/images/carlla-willstons.jpg" alt="">
                                </div>
                                <h3 class="text-center mt-3 mb-0">Carlla Willstons</h3>
                                <p class="text-center mt-1 third-clr">Reporter</p>
                            </div>
                        </div>


                        <div class="owl-carousel bg-gray owl-carousel5 owl-theme my-5 pb-5">
                            <div>
                                <div class="card bg-gray">
                                    <h3 class="text-center mt-3 mb-0">Twitter Posts</h3>
                                    <hr class="mx-auto" />
                                    <p class="text-center mt-1">To take a trivial example, which of us ever undertakes
                                        laborious physical exercise, some advantage from it? </p>
                                    <p class="text-center my-1"><span>14 minutes ago</span></p>
                                </div>

                            </div>
                            <div>
                                <div class="card bg-gray">
                                    <h3 class="text-center mt-3 mb-0">Twitter Posts</h3>
                                    <hr class="mx-auto" />
                                    <p class="text-center mt-1">To take a trivial example, which of us ever undertakes
                                        laborious physical exercise, some advantage from it? </p>
                                    <p class="text-center my-1"><span>14 minutes ago</span></p>
                                </div>

                            </div>
                            <div>
                                <div class="card bg-gray">
                                    <h3 class="text-center mt-3 mb-0">Twitter Posts</h3>
                                    <hr class="mx-auto" />
                                    <p class="text-center mt-1">To take a trivial example, which of us ever undertakes
                                        laborious physical exercise, some advantage from it? </p>
                                    <p class="text-center my-1"><span>14 minutes ago</span></p>
                                </div>

                            </div>
                            <div>
                                <div class="card bg-gray">
                                    <h3 class="text-center mt-3 mb-0">Twitter Posts</h3>
                                    <hr class="mx-auto" />
                                    <p class="text-center mt-1">To take a trivial example, which of us ever undertakes
                                        laborious physical exercise, some advantage from it? </p>
                                    <p class="text-center my-1"><span>14 minutes ago</span></p>
                                </div>

                            </div>


                        </div>

                        <h3 class="text-center">Follow Us</h3>
                        <hr class="mx-auto" />
                        <nav class="nav nav-fill mx-auto mb-5">
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

                        <h3 class="text-center">Instagram</h3>
                        <hr class="mx-auto" />
                        <div class="row insta-links mt-2">
                            <div class="col-md-4 col-sm-6 col-6">
                                <div class="card">
                                    <img class="card-img w-100" src="{{asset('images/insta1.png')}} " alt="">
                                    <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                        <a href="#"><img src="assets/images/right-icon.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-6">
                                <div class="card">
                                    <img class="card-img w-100" src="{{asset('images/insta2.png')}}" alt="">
                                    <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                        <a href="#"><img src="assets/images/right-icon.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-6">
                                <div class="card">
                                    <img class="card-img w-100" src="{{asset('images/insta3.png')}}" alt="">
                                    <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                        <a href="#"><img src="assets/images/right-icon.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-6">
                                <div class="card">
                                    <img class="card-img w-100" src="assets/images/insta4.png" alt="">
                                    <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                        <a href="#"><img src="assets/images/right-icon.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-6">
                                <div class="card">
                                    <img class="card-img w-100" src="assets/images/insta5.png" alt="">
                                    <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                        <a href="#"><img src="assets/images/right-icon.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-6">
                                <div class="card">
                                    <img class="card-img w-100" src="assets/images/insta6.png" alt="">
                                    <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                        <a href="#"><img src="assets/images/right-icon.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="text-center mt-5">Trending Posts</h3>
                        <hr class="mx-auto" />
                        <div class="tranding-posts mt-4">


                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            <h2 class="logo text-center">Shahala</h2>
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
        <div class="copy-right mt-4">
            <p class="text-center">&copy; 2019 <a href="#" class="text-white">Shahala</a>. All Rights Reserved. Design
                by <a href="https://freehtml5.co/shahala" target="_blank" class="text-white">FreeHTML5.co</a>.</p>
        </div>
    </footer>

    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/jquery-1.12.0.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.yu2fvl.js')}}"></script>
    <script src="{{asset('js/main.js')}"></script>


</body>

</html>


<style>
    // JavaScript code sử dụng jQuery
$('.favorite-button').click(function () {
    var newsId = $(this).data('news-id');
    $.ajax({
        method: 'POST',
        url: '/favorite/' + newsId,
        success: function (response) {
            alert(response.message);
        },
        error: function () {
            alert('Đã xảy ra lỗi.');
        }
    });
});

$('.unfavorite-button').click(function () {
    var newsId = $(this).data('news-id');
    $.ajax({
        method: 'DELETE',
        url: '/favorite/' + newsId,
        success: function (response) {
            alert(response.message);
        },
        error: function () {
            alert('Đã xảy ra lỗi.');
        }
    });
});

</style>
