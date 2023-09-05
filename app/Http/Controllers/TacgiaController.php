<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LichSuXemTin;
use App\Models\tin;
use App\Models\Comment;

use App\Models\Categories;
class TacgiaController extends Controller
{
    function table($id){
        $user = User::find($id);
        if ($user == null) {
            $thongbao = "Xóa tin tức thất bại";
        } else {
            $data = \App\Models\tin::where('idtacgia', $user->id)->paginate(3);
            return view('tacgia.tabletacgia', ['data' => $data],['tin'=>$user]);
        }
    }

    function addnew($id, Request $request){

            $request->validate([
                'tieude' => 'required|string',
                'tomtat' => 'required',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra file ảnh có đúng định dạng và kích thước không
            ]);
            $user = User::find($id);
            $t = new tin;
            $t->idtacgia = $user->id;
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
            return redirect()->route('tacgia', ['id' => $id])->with('thongbao', $thongbao);
        }
        function edit($id){
            if (session()->has('user')){
                $user = session('user');
                $iduser = $user->id;
            }
            $t = tin::find($id);
            if($t==null) return redirect('/thongbao');
            return view('tacgia.updatetacgia', ['tin'=>$t]);
        }
        function edit_(Request $request, $id) {
            $request->validate([
                'tieude' => 'required|string',
                'tomtat' => 'required',
                'noidung' => 'required',
            ]);
            if (session()->has('user')){
                $user = session('user');
                $iduser = $user->id;
            }
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


            return redirect()->route('tacgia', ['id' => $iduser])->with('thongbao', $thongbao);
        }
        function delnew($id) {
            if (session()->has('user')){
                $user = session('user');
                $iduser = $user->id;
            }
            $t = tin::find($id);
            if ($t == null) {
                $thongbao = "Xóa tin tức thất bại";
            } else {
                $t->delete();
                $thongbao = "Xóa tin tức thành công";
            }
            return redirect()->route('tacgia', ['id' => $iduser])->with('thongbao', $thongbao);
        }
        function search(Request $request){
            $keyword = $request->input('keyword');
dd($keyword);
            // $keyword = $request->input('keyword');
            // $listtin = tin::where('tieude', 'LIKE', "%$keyword%")
            //     ->orWhere('tomtat', 'LIKE', "%$keyword%")
            //     ->orWhere('noidung', 'LIKE', "%$keyword%");

            // if (session()->has('user')){
            //     $user = session('user');
            //     $iduser = $user->id;
            //     $listtin = $listtin->where('idtacgia', $iduser);
            // }

            // $listtin = $listtin->get();
            // dd($listtin);        }
    }

    public function thongKeTinTuc($id)
    {
        $tin = User::find($id);
        $iduser = $tin->id;

        $tongtin = tin::where('idtacgia', $id)->count();


        $cacloaitin = tin::where('idtacgia', $iduser)->get(); // Thêm phương thức get() để lấy các bản ghi

        $tongcacloaitin = LichSuXemTin::whereIn('idnew', $cacloaitin->pluck('id'))->count(); // Sử dụng whereIn() thay vì where()

        // Các mã lệnh khác không thay đổi

        $tongTinTheoThang = tin::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
        ->where('idtacgia',$id)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Chuyển đổi dữ liệu theo định dạng của Chart.js
        $labels = $tongTinTheoThang->map(function ($item) {
            return $item->month . '/' . $item->year;
        });
        $data = $tongTinTheoThang->pluck('count');

        return view('tacgia.bieudo', compact('labels', 'data', 'tin','tongtin','tongcacloaitin'))->with('router', route('bieudo.route', ['id' => $tin->id]));
    }
    function binhluan($id){
        $tin = User::find($id);
        $iduser = $tin->id;
        $tinhtrang = "Đã duyệt";
        $tongtin = tin::where('idtacgia', $iduser)->get();

        $data = Comment::whereIn('idnew', $tongtin->pluck('id'))
        ->where('tinhtrang',$tinhtrang)
        ->get(); // Sử dụng pluck() để lấy danh sách các "id" và sử dụng whereIn() để lấy các bình luận có "idnew" thuộc danh sách các "id"

        return view('tacgia.binhluan', ['data' => $data], ['tin' => $tin]);

    }
    function editbluan($id) {
        $tinhtrang = "Đã duyệt";
        $t = Comment::find($id);
        $thongbao = '';

        if (session()->has('user')) {
            $user = session('user');
            $iduser = $user->id;

            if ($t != null) {
                // Lấy dữ liệu từ request (Nếu có cần thiết)

                // Cập nhật trạng thái của comment
                $t->tinhtrang = $tinhtrang;
                $t->save();

                $thongbao = "Sửa tin tức thành công";
            } else {
                $thongbao = "Sửa tin tức thất bại";
            }
        } else {
            $thongbao = "Bạn chưa đăng nhập";
        }

        return redirect()->route('binhluan', ['id' => $iduser])->with('thongbao', $thongbao);
    }


}
