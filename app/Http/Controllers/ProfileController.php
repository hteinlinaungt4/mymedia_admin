<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //index
    function index(){
        $id=Auth::user()->id;
        $userdata=User::find($id)->first();
        return view('admin.profile.index',compact('userdata'));
    }
    // change password page
    function changepasswordpage(){
        return view('admin.profile.changepassword');
    }
    // change password
    function changepassword(Request $request){
        // $this->getpw($request);
        $this->pwcheck($request);
        $id=$request->id;
        $oldpassword=User::find($id)->select('password')->first();
        $oldpassword=$oldpassword['password'];
        if(Hash::check($request->oldpassword,$oldpassword)){
           User::where('id',$id)->update([
            'password' => Hash::make($request->newpassword)
           ]);
           return redirect()->route('dashboard');
        }else{
            return back()->with(['error' => 'Old Password does not match!']);
        }

    }



    // update
    function update(Request $request){
        $this->validation($request);
        $updatedata=$this->getData($request);
        $id=$request->id;
        User::where('id',$id)->update($updatedata);
        return back()->with(['UpdateSuccess' => 'You are created Successfully!']);
    }
    // pw check
    private function pwcheck($request){
        $validation=[
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'comfirmpassword' => 'required|same:newpassword',
        ];
        Validator::make($request->all(),$validation)->validate();
    }
     // pw get
    //  private function getpw($request){
    //     $data=[
    //         'oldpassword'=>$request->oldpassword,
    //         'newpassword'=>$request->newpassword,
    //         'comfirmpassword'=>$request->comfirmpassword,
    //     ];
    //     return $data;
    //  }
    // data
    private function getData($request){
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
        return $data;
    }
    // validate
    private function validation($request){
        $vali=[
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ];
        Validator::make($request->all(),$vali)->validate();
    }
}
