<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(News $news)
    {
        auth()->user()->favorites()->attach($news->id);
        return response()->json(['message' => 'Đã thêm tin tức vào mục yêu thích.']);
    }

    public function destroy(News $news)
    {
        auth()->user()->favorites()->detach($news->id);
        return response()->json(['message' => 'Đã xóa tin tức khỏi mục yêu thích.']);
    }
}

