<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //all
    function allcategory(){
        $category=Category::all();
        return response()->json([
            'category' => $category,
        ], 200);
    }
    // search
    function search(Request $request){
        $key=$request->key;
        if($key == 0){
            $post=Post::all();
        }else{
            $post=Post::orwhere('category_id',$key)->get();
        }
        return response()->json([
            'post' => $post,
        ], 200);
    }
}
