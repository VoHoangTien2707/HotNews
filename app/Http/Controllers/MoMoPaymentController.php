<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MoMo\Payment\PaymentRequest;

class MoMoPaymentController extends Controller
{
    public function handlePaymentResult(Request $request)
    {
        // Xử lý kết quả thanh toán từ MoMo
        $data = $request->all();

        // Kiểm tra kết quả thanh toán và xử lý dữ liệu trả về từ MoMo

        // Trả về trang kết quả thanh toán
        return view('payment.result', ['data' => $data]);
    }
}
