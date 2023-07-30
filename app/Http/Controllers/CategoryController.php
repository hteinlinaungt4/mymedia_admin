<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //index
    function index(){

        $categories=Category::when(request('search'),function($p){
            $key=request('search');
            $p->orwhere('title','like','%'.$key.'%');
            $p->orwhere('description','like','%'.$key.'%');
        })
        ->get();
        return view('admin.category.list',compact('categories'));
    }

    //crate
    function create(Request $request){
        $this->validation($request);
        $data=$this->getData($request);
        Category::create($data);
        return back()->with(['Msg' => 'You are created Successfully!']);
    }
    // delete
    function delete($id){
        Category::find($id)->delete();
        return back()->with(['Msg' => 'You are deleted Successfully!']);
    }
    // edit page
    function editpage($id){
        $editdata=Category::where('id',$id)->first();
        $categories=Category::all();
        return view('admin.category.edit',compact('categories','editdata'));
    }
    // update
    function update(Request $request){
        $this->validation($request);
        $update=$this->getData($request);
        $id=$request->id;
        Category::where('id',$id)->update($update);
        return redirect()->route('admin#category')->with(['Msg' => 'You are Updated Successfully!']);
    }

    // validate
   private function validation($request){
        $validation=[
            'title' => 'required|unique:categories,title,'.$request->id,
            'description' => 'required',
        ];
        Validator::make($request->all(),$validation)->validate();
    }
    // data
    private function getData($request){
        $data=[
            'title' => $request->title,
            'description' => $request->description,
        ];
        return $data;
    }
}
