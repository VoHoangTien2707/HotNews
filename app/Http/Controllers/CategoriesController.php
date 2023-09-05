<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Categories;

class CategoriesController extends Controller

{

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back();
    }

    public function tabledm(){
        $data = \App\Models\Categories::all();
        return view('admin.tabledm', ['data'=>$data]);
    }
    function addnew(Request $request){
        $t = new Categories;
        $t->ten = $request->input('ten');
        // if ($request->hasFile('img')) {
        //     // Xác minh rằng hình ảnh cũ tồn tại trước khi xóa
        //     if (Storage::disk('public')->exists($t->img)) {
        //         // Xóa hình ảnh cũ
        //         Storage::disk('public')->delete($t->img);
        //     }

        //     $imagePath = $request->file('img')->store('images', 'public');
        //     $t->img = $imagePath;
        // }

        $thongbao = "thêm tin tức thành công";
        $t->save();
        return redirect('/admin/tabledm')->with('thongbao', $thongbao);
    }
    function edit($id){
        $t = Categories::find($id);
        if($t==null) return redirect('/thongbao');
        return view('admin.updatenewdm', ['tin'=>$t]);
    }
    function edit_(Request $request, $id) {
        $t = Categories::find($id);
        if ($t == null){
            $thongbao = "Sửa tin tức thất bại";

        }else{

        // Lấy dữ liệu từ request
        $t->ten = $request->input('ten');
        $t->hienthi = $request->input('hienthi');
        $thongbao = "Sửa tin tức thành công";
        $t->save();
        }


        return redirect('/admin/tabledm')->with('thongbao', $thongbao);
    }
    function delnew($id) {
        $t = Categories::find($id);
        if ($t == null) {
            $thongbao = "Xóa tin tức thất bại";
        } else {
            $t->delete();
            $thongbao = "Xóa tin tức thành công";
        }
        return redirect('/admin/tabledm')->with('thongbao', $thongbao);
    }

}
