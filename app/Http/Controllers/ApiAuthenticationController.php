<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthenticationController extends Controller
{
    public function register(Request $request){
        $validatorData = $request->only("name","email","password","c_password");
        $validator  = validator::make(
            $validatorData,
            [
                "name" =>"required",
                "email" =>"required|email",
                "password" =>"required",
                "c_password" =>"required|same:password",
            ]
            );
            if($validator->fails()){
                return response()->json($validator->errors(),400);
            }
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $response['token'] = $user->createToken('MyAppToken')->plainTextToken;
            $response['name']= $user->name;
            return response()->json($response,200);
    }
    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email ,'password'=>$request->password])){
            $user = Auth::user();
            $response['token'] = $user->createToken('MyAppToken')->plainTextToken;
            $response['name']= $user->name;
            return response()->json($response,200);
        } else {
            return response()->json("Invalid Credentials",400);
        }

    }
    public function detail()
    {
        $user = Auth::user();
        $response['user']= $user;
        return response()->json($response,200);
    }

}
