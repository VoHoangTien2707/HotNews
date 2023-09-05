<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LichSuXemTin;
use App\Models\tin;
use Illuminate\Support\Facades\Storage; // Thêm dòng này

use App\Models\Categories;

use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function profile($id){
        $t = User::find($id);
        if($t==null) return redirect('/thongbao');
        $loaitin = Categories::all();
        return view('profile.profile', ['tin'=>$t],['data1'=>$loaitin]);
    }

    function edit_(Request $request, $id) {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'dienthoai' => 'required',
            'diachi' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $t = User::find($id);
        if ($t == null){
            $thongbao = "Sửa tin tức thất bại";

        }else{

        // Lấy dữ liệu từ request
        $t->email = $request->input('email');

        $t->name = $request->input('name');
        $t->dienthoai = $request->input('dienthoai');
        $t->diachi = $request->input('diachi');


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
            }
        }
        $thongbao = "Sửa User thành công";
        $t->save();
        }


        return redirect('/profile/' . $id)->with('thongbao', $thongbao);
    }

    function lichsuxemtin($id){
        $t = User::find($id);
        $loaitin = Categories::all();

        if($t == null){
            return redirect('/thongbao');
        }
        // Lấy danh sách các tin đã xem của người dùng
        $ls = LichSuXemTin::where('iduser', $t->id)->get();
        // Tạo một mảng chứa danh sách các ID tin đã xem
        $tin_da_xem_ids = $ls->pluck('idnew')->toArray();
        // Lấy thông tin của các tin đã xem thông qua danh sách các ID
        $tin_da_xem = Tin::whereIn('id', $tin_da_xem_ids)->paginate(3);

        return view('profile.lichsu', ['tin' => $t, 'data1' => $tin_da_xem, 'ls'=>$ls]);
    }
}
