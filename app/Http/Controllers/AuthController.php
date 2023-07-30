<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    function login(Request $request){
        logger($request->all());
        $user=User::where('email',$request->email)->first();
        if(isset($user)){
            if(Hash::check($request->password,$user->password)){
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ], 200);
            }else{
                return response()->json([
                    'user' => null,
                    'token' => null,
                ], 200);
            }
        } else{
            return response()->json([
                'user' => null,
                'token' => null,
            ], 200);
        }
    }
    // register
    function register(Request $request){
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::create($data);
        $user=User::where('email',$request->email)->first();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
        ], 200);
    }

    // category
    function category(){
        return response()->json([
            'msg' => 'success',
        ], 200);
    }
}
