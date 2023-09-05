<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\tin;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Package;

class AdminController extends Controller
{
    function trangchu(){
        return view('chitiet');
    }
    function table(){
        $data = \App\Models\tin::paginate(3);
        return view('admin.table', ['data'=>$data]);
    }
    function addnew(Request $request){
        $request->validate([
            'tieude' => 'required|string',
            'tomtat' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra file ảnh có đúng định dạng và kích thước không
        ]);
        $t = new tin;
        $t->tieude = $request->input('tieude');
        $t->tomtat = $request->input('tomtat');
        // if ($request->hasFile('img')) {
        //     // Xác minh rằng hình ảnh cũ tồn tại trước khi xóa
        //     if (Storage::disk('public')->exists($t->img)) {
        //         // Xóa hình ảnh cũ
        //         Storage::disk('public')->delete($t->img);
        //     }

        //     $imagePath = $request->file('img')->store('images', 'public');
        //     $t->img = $imagePath;
        // }
        if ($request->hasFile('img')) {
            $image = $request->file('img');

            // Kiểm tra xem tập tin tải lên có phải là hình ảnh hợp lệ (ví dụ: jpg, png, gif)
            if ($image->isValid() && in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {


                // Lưu tập tin hình ảnh mới vào thư mục public/images (bạn có thể sử dụng thư mục khác tuỳ ý)
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $t->img = $imageName;
            } else {
                // Xử lý lỗi nếu tập tin không hợp lệ
                return redirect()->back()->with('error', 'Tập tin không hợp lệ. Vui lòng tải lên hình ảnh có định dạng jpg, jpeg, png hoặc gif.');
            }
        }
        $thongbao = "thêm tin tức thành công";
        $t->idlt = $request->input('idlt');
        $t->save();
        return redirect('/admin/table')->with('thongbao', $thongbao);
    }
    function delnew($id) {
        $t = tin::find($id);
        if ($t == null) {
            $thongbao = "Xóa tin tức thất bại";
        } else {
            $t->delete();
            $thongbao = "Xóa tin tức thành công";
        }
        return redirect('/admin/table')->with('thongbao', $thongbao);
    }
   function edit_(Request $request, $id) {

    $request->validate([
        'tieude' => 'required|string',
        'tomtat' => 'required',
        'noidung' => 'required',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra file ảnh có đúng định dạng và kích thước không
    ]);
    $t = tin::find($id);
    if ($t == null){
        $thongbao = "Sửa tin tức thất bại";

    }else{

    // Lấy dữ liệu từ request
    $t->tieude = $request->input('tieude');
    $t->tomtat = $request->input('tomtat');
    $t->noidung = $request->input('noidung');

    // if ($request->hasFile('img')) {
    //     // Xác minh rằng hình ảnh cũ tồn tại trước khi xóa
    //     if (Storage::disk('public')->exists($t->img)) {
    //         // Xóa hình ảnh cũ
    //         Storage::disk('public')->delete($t->img);
    //     }

    //     $imagePath = $request->file('img')->store('images', 'public');
    //     $t->img = $imagePath;
    // }
    if ($request->hasFile('img')) {
        $image = $request->file('img');

        // Kiểm tra xem tập tin tải lên có phải là hình ảnh hợp lệ (ví dụ: jpg, png, gif)
        if ($image->isValid() && in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
            // Xác minh rằng hình ảnh cũ tồn tại trước khi xóa
            if (Storage::disk('public')->exists($t->img)) {
                // Xóa hình ảnh cũ
                Storage::disk('public')->delete($t->img);
            }

            // Lưu tập tin hình ảnh mới vào thư mục public/images (bạn có thể sử dụng thư mục khác tuỳ ý)
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $t->img = $imageName;
        } else {
            // Xử lý lỗi nếu tập tin không hợp lệ
            return redirect()->back()->with('error', 'Tập tin không hợp lệ. Vui lòng tải lên hình ảnh có định dạng jpg, jpeg, png hoặc gif.');
        }
    }
    $t->idlt = $request->input('idlt');
    $thongbao = "Sửa tin tức thành công";
    $t->save();
    }


    return redirect('/admin/table')->with('thongbao', $thongbao);
}

function edit($id){
    $t = tin::find($id);
    if($t==null) return redirect('/thongbao');
    return view('admin.updatenew', ['tin'=>$t]);
}

function editorder($id){
    $t = Package::where('id',$id)->first();
    if($t==null) return redirect('/thongbao');
    dd($t);
 }
}
