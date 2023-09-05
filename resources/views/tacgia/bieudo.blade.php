@extends('tacgia.layouttacgia')
@section('noidung')

<div class="container">
<div class="mkp">
<div class="tong">
    Tổng cổng có {{$tongtin}} tức
    Tổng {{$tongcacloaitin}}
</div>
<div class="tong1">
    Có {{$tongcacloaitin}} người quan tâm đến tin tức của bán
</div>
</div>

<div class="mp4">
<canvas id="myChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Số lượng tin tức',
                    data: @json($data),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>

<style>
    .tong{
        width: 200px;
        height:100px;
        background-color:blue;
        color:white;
        font-size:20px;
        padding:10px;
        line-height:80px;
        font-weight: bold;
        margin-bottom:30px;

    }
    .tong1{
        width: 200px;
        height:100px;
        background-color:red;
        color:white;
        font-size:20px;
        padding:10px;
              font-weight: bold;
        margin-bottom:30px;
        margin-left:100px;
    }
    .mp4{
        background-color:white;
        padding:15px;
    }
    .mkp{
        display:flex;
        margin-right:200px;
    }
</style>
@endsection
