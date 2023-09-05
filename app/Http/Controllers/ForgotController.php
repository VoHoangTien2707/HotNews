<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;

class ForgotController extends Controller
{
    function forgetpassword(){
        return view('dangnhap.forgetpassword');
    }
    function postforgetpassword (Request $reg){
        $reg->validate([
            'email' => 'required|exists:users,email',
        ]);

        $customer = User::where('email',$reg->email)->first();
            Mail::send('emails.check', compact('customer'), function($email) use($customer){
                $email->subject('Hoang tien');
                $email->to($customer->email, $customer->name);
           });
           return redirect()->route('customer.forgetpass')->with('error', 'Vui lòng check gmail để đổi mật khẩu.');


    }
    function getpassword($id){
        $t = User::find($id);
        if($t==null) return redirect('/thongbao');
        return view('dangnhap.getpass', ['tin'=>$t]);
    }
    function postpassword(Request $request, $id){

        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $t = User::find($id);
        if ($t == null){
            $thongbao = "Sửa tin tức thất bại";

        }else{
            $t->password = bcrypt($request->input('password'));
            $t->save();
            $thongbao = "";

        }
        return redirect('/dangnhap')->with('thongbao', $thongbao);


    }
}
