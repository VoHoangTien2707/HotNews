<div class="png" style="width:600px; margin:0 auto; background-color: #0073e6
; color:white;text-align:center; padding:20px;">
<div style="">
<h2 style="color:white">Xin chào {{$customer->name}}</h2>
<p style="color:white">Email này để giúp bạn lấy lại mật khẩu tại khoản đã bị quên</p>
<p style="color:white">Vui lòng click vào link dưới đây để lấy lại</p>
<a href="{{route('customer.getpass',$customer->id)}}">
<button style="background-color:white;color:black; border:none; ">Lấy lại mật khẩu</button>

</a>
<p>
</p>
</div>

</div>
<style>
    .png{
        border:3px solid red;

    }
    .png h2{
        text-align:center;
        color:red;

    }
    .png p{
        text-align:center;

    }
    .png button{
        margin:0 auto;
        background-color:red;
        border:none;
        color:white;
    }
    element.style {
    TEXT-ALIGN: CENTER;
    /* border: 2px solid red; */
    background-color: #80bfff;
    padding: 20px;
    color: white;
}
</style>
