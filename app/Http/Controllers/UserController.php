<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comment;
use App\Models\LichSuXemTin;
use App\Models\tin;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller

{
    function show(){
        $kq = DB::table("tbl_users")
        ->select('id','username','email')
        ->where ('id','=','1')
        ->get();
        return view('showdb', ['data'=>$kq]);
    }

    function index() {
        $tin = DB::table("tbl_tin")
            ->select('id', 'tieude', 'tomtat', 'noidung', 'luotxem', 'img', 'ngaydang')
            ->orderBy('luotxem', 'desc')
            ->limit(3)
            ->get();

        $loaitin = DB::table("tbl_loaitin")
            ->select('id', 'ten', 'hienthi')
            ->limit(4)
            ->get();

        $loaitinIds = $loaitin->pluck('id')->toArray();

        $loctinByCategory = [];
        foreach ($loaitinIds as $categoryId) {
            $loctinByCategory[$categoryId] = DB::table('tbl_tin')
                ->where('idlt', $categoryId)
                ->orderBy('luotxem', 'desc')
                ->limit(4)
                ->get();
        }

        return view('home', ['data' => $tin, 'data1' => $loaitin, 'loctinByCategory' => $loctinByCategory]);
    }
    function view($id){
        $category = DB::table("tbl_tin")
        ->where('idlt',$id)
        ->get();
        return view('Category', ['data'=>$category]);
    }

    function tintrongloai($idlt=0){
        $listtin = DB::table('tbl_tin')->where('idlt', $idlt)->get();


        $data = ['idlt'=>$idlt,'listtin'=>$listtin];
        return view("tintrongloai",$data);
    }
    function chitiet($id=0){
        $tin = DB::table('tbl_tin')->where('id',$id)->first();
        $tinhtrang = 'Đã duyệt';
        $comments = Comment::where('idnew', $id)
        ->where('tinhtrang',$tinhtrang)
        ->get();
        if (auth()->check()) {
            $user = auth()->user();
            LichSuXemTin::create([
                'iduser' => $user->id,
                'idnew' => $tin->id,
                'thoigianxem' => Carbon::now(),
            ]);
        }


        $data= ['id'=>$id,'tin'=>$tin,'comment'=>$comments];
        return view('chitiet', $data);
    }
    function search(Request $request){
        $keyword = $request->input('keyword');
        $listtin = DB::table("tbl_tin")
        ->where('tieude','LIKE',"%$keyword%")
        ->orWhere('tomtat','LIKE',"%$keyword%")
        ->orWhere('noidung','LIKE',"%$keyword%")
        ->get();
        return view('tintrongloai', compact('listtin'));

    }
    function searchByTime(Request $request)
    {
        $days = $request->input('days');

        $startDateTime = Carbon::now()->subDays($days);

        $listtin = DB::table("tbl_tin")
        ->where('ngaydang','>=',$startDateTime)
        ->get();

        return view('tintrongloai', compact('listtin'));
    }
    function dangnhap(){
        return view('dangnhap.dangnhap');
    }
    function dangky(){
        return view('dangnhap.dangky');
    }
    function trangchu(){
        return view('chitiet');
    }

    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt([
         'email' => $request->input('email'),
         'password' => $request->input('password')
        ], $request->input('remember')
         )) {
            $user = Auth::user();
            if ($user->role === 'Admin') {
                $request->session()->put('user', $user);

                return redirect()->route('admin'); // Chuyển hướng đến trang admin dashboard
            } else if($user->role === 'User') {
                $request->session()->put('user', $user);

                return redirect()->route('trangchu'); // Chuyển hướng đến trang user dashboard
            }else{
                $request->session()->put('user', $user);

                return redirect()->route('admin');
            }
            // Xác thực thành công
        } else {
            // Xác thực không thành công
            return redirect()->route('dangnhap')->with('error', 'Đăng nhập không thành công! Vui lòng kiểm tra lại email và mật khẩu.');
        }
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect to login page after successful registration
        return redirect()->route('dangnhap')->with('success', 'Đăng ký thành công!');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng
        $request->session()->invalidate(); // Xóa session hiện tại
        $request->session()->regenerateToken(); // Tạo token session mới
        return redirect()->route('trangchu'); // Chuyển hướng về trang chủ hoặc trang khác sau khi đăng xuất
    }
    function tableuser(){
        $data = \App\Models\User::paginate(3);
        return view('admin.tableuser', ['data'=>$data]);
    }
    function edit($id){
        $t = User::find($id);
        if($t==null) return redirect('/thongbao');
        return view('admin.updatenewuser', ['tin'=>$t]);
    }
    function edit_(Request $request, $id) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        $t = User::find($id);
        if ($t == null){
            $thongbao = "Sửa tin tức thất bại";

        }else{

        // Lấy dữ liệu từ request
        $t->name = $request->input('name');
        $t->email = $request->input('email');
        $t->password = $request->input('password');

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
        $thongbao = "Sửa User thành công";
        $t->save();
        }


        return redirect('/admin/tableuser')->with('thongbao', $thongbao);
    }
    function deluser($id) {
        $t = User::find($id);
        if ($t == null) {
            $thongbao = "Xóa user thất bại";
        } else {
            $t->delete();
            $thongbao = "Xóa user thành công";
        }
        return redirect('/admin/tableuser')->with('thongbao', $thongbao);
    }
    function addnew(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        $t = new User;
        $t->name = $request->input('name');
        $t->email = $request->input('email');
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
        $t->password = $request->input('password');

        $thongbao = "thêm tin tức thành công";
        $t->role = $request->input('role');
        $t->save();
        return redirect('/admin/tableuser')->with('thongbao', $thongbao);
    }
    function edituser($id){
        $t = User::find($id);
        if($t==null) return redirect('/thongbao');
        return view('admin.updateorder', ['tin'=>$t]);
    }
}
