<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LichSuXemTin;
use App\Models\tin;
use App\Models\Package;
use App\Models\Categories;
use App\Models\Order;

class MuaHangController extends Controller
{
    function muahang($id){
        $t = User::find($id);

        if($t == null) return redirect('/thongbao');

        $loaitin = Categories::all();
        return view('profile.muahang', ['tin' => $t, 'data1' => $loaitin]);
    }
}
