<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    function post(){
        $posts=Post::all();
        return response()->json([
            'post' => $posts,
        ], 200);
    }

    // search
    function search(Request $request){
        $key=$request->key;
        $post=Post::orwhere('title','like','%'.$key.'%')->get();
        return response()->json([
            'post' => $post,
        ], 200);
    }
    // filter
    function filter(Request $request){
        $id=$request->key;
        $post=Post::where('id',$id)->first();
        return response()->json([
            'post' => $post,
        ],200);
    }

    // // viewcount
    function viewcount(Request $request){
        $id=$request->id;
        $orgcount=Post::select('viewcount')->where('id',$id)->first();
        $updatecount=Post::where('id',$id)->update([
            'viewcount' => $orgcount->viewcount +1,
        ]);
        return response()->json([
            'count' => $orgcount->viewcount + 1 ,
        ], 200);
    }
}
