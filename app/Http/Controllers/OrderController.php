<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\LichSuXemTin;
use App\Models\tin;
use App\Models\Package;

use App\Models\Order;
use App\Models\Categories;
use Illuminate\Http\Request;

class OrderController extends Controller{
    function order($id){
        $t = Package::where('id',$id)->first();
        if (session()->has('user')){
            $user = session('user');
            $iduser = $user->id;
        }
        $tin = User::where('id',$iduser)->first();

        return view('order.viewcard', ['ds' => $t, 'tin' => $tin, 'idnew' => $id]);
    }
    function ordergoi(){
        $loaitin = Categories::all();
        $tin = Package::all();
        return view('order.goi',['ds'=>$tin],['data1'=>$loaitin]);
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }


    function edit_(Request $request) {
        $t = new Order;

        $tin = Package::where('id',$request->input('idnew'))->first();

        $duration = $tin->duration;
        $t->iduser = $request->input('iduser');
        $t->idnew = $request->input('idnew');
        $t->name = $request->input('name');
        $t->ngayhethang = now()->addDays($duration);

        $t->gmail = $request->input('email');
        $t->dienthoai = $request->input('dienthoai');
        $t->tongdonhang = $request->input('tongdonhang');
        $t->pttt = $request->input('pttt');
        $t->save();



        // if ($request->hasFile('img')) {
        //     // Xác minh rằng hình ảnh cũ tồn tại trước khi xóa
        //     if (Storage::disk('public')->exists($t->img)) {
        //         // Xóa hình ảnh cũ
        //         Storage::disk('public')->delete($t->img);
        //     }

        //     $imagePath = $request->file('img')->store('images', 'public');
        //     $t->img = $imagePath;
        // }
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua MoMo";
$amount = $t->tongdonhang;
$orderId = rand(00,9999);
$redirectUrl = "http://127.0.0.1:8000/";
$ipnUrl = "http://127.0.0.1:8000/";
$extraData = "";


if (!empty($_POST)) {
    $partnerCode = $partnerCode;
    $accessKey = $accessKey;
    $serectkey = $secretKey;
    $orderId = $orderId;// Mã đơn hàng

    $orderInfo = $orderInfo;
    $amount = $amount;
    $ipnUrl = $ipnUrl;
    $redirectUrl = $redirectUrl;
    $extraData = $extraData;

    $requestId = time() . "";
    $requestType = "payWithATM";
    // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $serectkey);
    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

    //Just a example, please check more in there

        // return redirect('/home')->with('thongbao', $thongbao);
        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']);
        } else {
            // Xử lý lỗi khi không có khóa 'payUrl' trong dữ liệu trả về từ API
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thanh toán qua MoMo.');
        }   }
}
function tableorder(){
    $data = \App\Models\Order::paginate(3);
    return view('admin.tableorder', ['data'=>$data]);
}

function delnew($id) {
    $t = Order::find($id);
    if ($t == null) {
        $thongbao = "Xóa tin tức thất bại";
    } else {
        $t->delete();
        $thongbao = "Xóa tin tức thành công";
    }
    return redirect('/admin/tableorder')->with('thongbao', $thongbao);
}
}
