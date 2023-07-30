<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //index
    function index(){
        $categories=Category::all();
        $posts=Post::all();
        return view('admin.post.index',compact('categories','posts'));
    }
    // delete
    function delete($id){
        $oldimage=Post::select('image')->find($id);
        $oldimage=$oldimage['image'];
        if($oldimage != null){
            Storage::delete('public/'.$oldimage);
        }
        Post::where('id',$id)->delete();
        return back()->with(['Msg' => 'You are deleted Post Successfully!']);
    }
    // edit
    function edit($id){
        $editpost=Post::where('id',$id)->first();
        $categories=Category::all();
        $posts=Post::all();
        return view('admin.post.edit',compact('categories','posts','editpost'));
    }
    // update
    function update(Request $request){
        $this->validation($request);
        $updateData=$this->getData($request);
        $id=$request->id;
        if($request->hasFile('image')){
            $oldimage=Post::select('image')->find($id);
            $oldimage=$oldimage['image'];
            if($oldimage != null){
                Storage::delete('public/'.$oldimage);
            }
            $name=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $path=$request->file('image')->storeAs('public',$name);
            $updateData['image']=$name;
        }
        Post::where('id',$id)->update($updateData);
        return redirect()->route('admin#post')->with(['Msg' => 'You are Updated Post Successfully!']);
    }

    // create
    function create(Request $request){
        $this->validation($request);
        $data=$this->getData($request);
        if($request->hasFile('image')){
           $imagename=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $path=$request->file('image')->storeAs('public',$imagename);
            $data['image']=$imagename;
        };
        Post::create($data);
        return back()->with(['Msg' => 'You are created Post Successfully!']);

    }

    // validation
    private function validation($request){
        $validation=[
            'title' => 'required|unique:posts,title,'.$request->id,
            'description' => 'required',
            'category' => 'required',
        ];
        Validator::make($request->all(),$validation)->validate();
    }

    // get data
    private function getData($request){
        $data=[
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
        ];
        return $data;
    }
}
