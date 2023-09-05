<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\TacgiaController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MuaHangController;
use App\Http\Controllers\OrderController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[UserController::class, 'index'])->name('trangchu')->middleware('checklogin');
Route::get('/cat/{id}',[UserController::class, 'tintrongloai']);
Route::get('/tin/{id}',[UserController::class, 'chitiet'])->name('chitiet');
Route::get('/dangnhap',[UserController::class, 'dangnhap'])->name('dangnhap');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/dangky', [UserController::class, 'dangky'])->name('dangky');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/dangxuat', [UserController::class, 'logout'])->name('logout');

Route::get('/products/search', [UserController::class, 'search'])->name('products.search');
Route::get('/products/search_by_time', [UserController::class, 'searchByTime'])->name('products.search_by_time');

Route::get('/about', function () {
    echo 'Day la gioi thieu';
    return view('welcome');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/chuc', function(){
    $str = "Kính chào quý khách";
    $t = "Chào quý khách";
    return view('chuc',['title'=>$t, 'chuc'=>$str]);
});
Route::get('/db',[UserController::class, 'show']);
Route::get('/db2', function(){
    $query = DB::table('tbl_users')->select('id','username');
    $kq = $query->first();
    print_r($kq);
    echo "<h2>{$kq->username}</h2>";
});
Route::post('/comments', [CategoriesController::class, 'store'])->name('comments.store');

Route::get('/db3', function(){
    $query = DB::table('tbl_users')
    ->select('id','username')
    ->$kq = $query->get();
    return view('data',['kq'=>$data]);
});
Route::get('/admin/trangchu', function(){
    return view('admin.home');
});

//show len table
Route::get('/admin/table', [AdminController::class, 'table'])->name('admin')->middleware('checklogin')->middleware('auth');
Route::get('/admin/tabledm', [CategoriesController::class, 'tabledm'])->middleware('auth');
Route::get('/admin/tableuser', [UserController::class, 'tableuser'])->middleware('auth');
Route::get('/admin/tablebinhluan', [CommentController::class, 'tablebinhluan'])->name('tablebinhluan')->middleware('auth');
Route::get('/admin/tableorder', [OrderController::class, 'tableorder'])->name('tableorder')->middleware('auth');

//news
Route::post('/admin/table/them', [AdminController::class, 'addnew'])->middleware('auth');
Route::get('/admin/table/delete/{id}', [AdminController::class, 'delnew'])->name('admin.table.delete')->middleware('auth');
Route::get('/admin/table/edit/{id}', [AdminController::class, 'edit'])->name('admin.table.edit')->middleware('auth');
Route::post('/admin/table/edit/{id}', [AdminController::class, 'edit_'])->name('admin.table.edit')->middleware('auth');
Route::post('/admin/tableuser/them', [UserController::class, 'addnew'])->middleware('auth');

//categories
Route::post('/admin/tabledm/them', [CategoriesController::class, 'addnew'])->middleware('auth');
Route::get('/admin/tabledm/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.tabledm.edit')->middleware('auth');
Route::post('/admin/tabledm/edit/{id}', [CategoriesController::class, 'edit_'])->name('admin.tabledm.edit')->middleware('auth');
Route::post('/chitiet/comment', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::get('/admin/tabledm/delete/{id}', [CategoriesController::class, 'delnew'])->name('admin.tabledm.delete')->middleware('auth');

//user

Route::get('/admin/tableuser/edit/{id}', [UserController::class, 'edit'])->name('admin.tableuser.edit')->middleware('auth');
Route::post('/admin/tableuser/edit/{id}', [UserController::class, 'edit_'])->name('admin.tableuser.edit')->middleware('auth');
Route::get('/admin/tableuser/delete/{id}', [UserController::class, 'deluser'])->name('admin.tableuser.delete')->middleware('auth');


//forgot password
Route::get('/forget-password',[ForgotController::class, 'forgetpassword'])->name('customer.forgetpass');
Route::post('/forget-password',[ForgotController::class, 'postforgetpassword']);
route::get('/actived/{customer}/{token}',[ForgotController::class, 'actived'])->name('customer.actived');
 route::post('get-password/{id}',[ForgotController::class, 'postpassword'])->name('postpassword');
 Route::get('/get-password/{id}', [ForgotController::class, 'getpassword'])->name('customer.getpass');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//profile

route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/profile/edit/{id}', [ProfileController::class, 'edit_'])->name('profile.edit')->middleware('auth');
route::get('/lichsuxemtin/{id}', [ProfileController::class, 'lichsuxemtin'])->name('lichsuxemtin')->middleware('auth');




Route::post('/favorite/{news}', 'FavoriteController@store')->name('favorite.store');
Route::delete('/favorite/{news}', 'FavoriteController@destroy')->name('favorite.destroy');

//muahang

route::get('/muahang/{id}', [MuahangController::class, 'muahang'])->name('muahang')->middleware('auth');
route::get('/ordergoi', [OrderController::class, 'ordergoi'])->name('ordergoi')->middleware('auth');


route::post('/order/{id}', [OrderController::class, 'order'])->name('order')->middleware('auth');
Route::post('/profile/order', [OrderController::class, 'edit_'])->name('donhang.addcard')->middleware('auth');

//tac gia

Route::get('/tacgia/{id}', [TacgiaController::class, 'table'])->name('tacgia')->middleware('auth');
Route::post('/admin/table/them/{id}', [TacgiaController::class, 'addnew'])->name('tacgia.add')->middleware('auth');

Route::get('/tacgia/table/edit/{id}', [TacgiaController::class, 'edit'])->name('tacgia.table.edit')->middleware('auth');
Route::post('/tacgia/table/edit/{id}', [TacgiaController::class, 'edit_'])->name('tacgia.table.edit')->middleware('auth');
Route::get('/tacgia/table/delete/{id}', [TacgiaController::class, 'delnew'])->name('tacgia.table.delete')->middleware('checklogin')->middleware('auth');;
Route::get('/tacgia/search', [TacgiaController::class, 'delnew'])->name('tin.search');




//bieu do

Route::get('/bieudo/{id}',[TacgiaController::class, 'ThongKeTinTuc'])->name('bieudo.route');



Route::get('/binhluan/{id}',[TacgiaController::class, 'binhluan'])->name('binhluan');
Route::get('/payment/success', [MoMoPaymentController::class, 'handlePaymentResult'])->name('payment.success')->middleware('auth');


Route::post('/tacgia/binhluan/edit/{id}', [TacgiaController::class, 'editbluan'])->name('tacgia.binhluan.edit')->middleware('auth');

//admincomment

Route::post('/admin/binhluan/edit/{id}', [CommentController::class, 'editbluan'])->name('admin.binhluan.edit')->middleware('auth');


Route::get('/admin/tableorder/edit/{id}', [AdminController::class, 'editorder'])->name('admin.tableorder.edit')->middleware('auth');
Route::get('/admin/tableuser/edit/{id}', [UserController::class, 'edituser'])->name('admin.tableuser.edit')->middleware('auth');
Route::get('/admin/tableorder/delete/{id}', [OrderController::class, 'delnew'])->name('admin.tableorder.delete')->middleware('auth');
