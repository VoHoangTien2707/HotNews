@extends('layout')
@section('noidung1')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>BẢNG GIÁ CÁC GÓI TIN TỨC</h2>
  <div class="row">
    @foreach($ds as $dt)
    <div class="col-4">
    <div class="card" style="width: 18rem;">
  <img src="{{asset('images/tintuc.jpg')}}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{$dt->name}}</h5>
    <p class="card-text">{{$dt->description}}</p>
    <p class="card-text">Thời gian: {{$dt->duration}} ngày</p>

    <h5 class="card-title">Giá: {{ number_format($dt->price, 0, ',', '.') }} đ</h5>
    <form action="{{ route('order', ['id' => $dt->id]) }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $dt->id }}">
                <button type="submit">Mua</button>
            </form>
  </div>
  </div>
  </div>

  @endforeach

</div>
    </div>

</div>
    </div>
  </div>
</div>
</body>
</html>
<style>
    .container h2{
        text-align:center;
        margin:20px;
        font-weight: bold;
        margin-bottom:40px;
    }
    .container{
        text-align:center;
    }
    .container button{
        background-color:black;
        width: 100px;
        color:white;
    }
</style>

@endsection
