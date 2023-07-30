<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TrendPostController extends Controller
{
    //index
    function index(){
        $trendpost=Post::orderBy('viewcount','desc')->get();
        return view('admin.TrendPost.index',compact('trendpost'));
    }
}
