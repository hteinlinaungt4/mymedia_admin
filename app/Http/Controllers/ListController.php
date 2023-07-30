<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //index
    function index(){
        $lists=User::when(request('search'),function($p){
            $key=request('search');
            $p->orwhere('name','like','%'.$key.'%');
            $p->orwhere('email','like','%'.$key.'%');
            $p->orwhere('address','like','%'.$key.'%');
            $p->orwhere('phone','like','%'.$key.'%');
            $p->orwhere('gender','like','%'.$key.'%');
        })->orderBy('created_at','desc')->get();
        return view('admin.adminlist.index',compact('lists'));
    }
    // delete
    function delete($id){
        User::find($id)->delete();
        return back()->with(['DeleteMsg' => 'You are deleted successfully!']);
    }
}
