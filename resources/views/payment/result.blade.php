<!DOCTYPE html>
<html>
<head>
    <title>Kết quả thanh toán MoMo</title>
</head>
<body>
    <h1>Kết quả thanh toán MoMo</h1>
    @if(isset($data['errorCode']) && $data['errorCode'] == 0)
        <p>Thanh toán thành công!</p>
        <p>Mã giao dịch: {{ $data['transId'] }}</p>
        <!-- Hiển thị các thông tin khác từ MoMo -->
    @else
        <p>Thanh toán thất bại!</p>
        <p>Lỗi: {{ $data['message'] }}</p>
    @endif
</body>
</html>
