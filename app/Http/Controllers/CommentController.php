<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
{
    if (session()->has('user')){
        $request->validate([
            'noidung' => 'required',
        ]);
        $comment = new Comment();
        $comment->name = $request->input('name'); // Lấy ID của người dùng đã đăng nhập
        $comment->noidung = $request->input('noidung');
        // Các trường khác của bình luận (nếu có) có thể được gán ở đây
        $comment->idnew = $request->input('idnew'); // Lấy ID của người dùng đã đăng nhập
        $comment->iduser = $request->input('iduser'); // Lấy ID của người dùng đã đăng nhập

        $comment->save();
        $id = $comment->idnew;
        return redirect()->route('chitiet', ['id' => $id]);
    }
    else{
        return redirect()->route('dangnhap')->with('error', 'Đăng nhập không thành công! Vui lòng kiểm tra lại email và mật khẩu.');

    }




    // Redirect hoặc trả về JSON response tùy theo yêu cầu của bạn
}

function tablebinhluan(){
    $data = \App\Models\comment::paginate(3);
    return view('admin.tablebinhluan', ['data'=>$data]);
}

function editbluan($id) {
    $tinhtrang = "Đã duyệt";
    $t = Comment::find($id);
    $thongbao = '';
            // Lấy dữ liệu từ request (Nếu có cần thiết)
            // Cập nhật trạng thái của comment
            $t->tinhtrang = $tinhtrang;
            $t->save();
            $thongbao = "Sửa tin tức thành công";

    return redirect()->route('tablebinhluan')->with('thongbao', $thongbao);
}
}
