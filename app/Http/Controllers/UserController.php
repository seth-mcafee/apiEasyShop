<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        
        // validar datos
        $validator = validator()->make($request->all(), [
            "email" => ["required", "email"],
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ]);
        }

        $credentials = $validator->valid();
        
        if(Auth::attempt($credentials)){
            
            return response()->json([
                "message" => "Successfully Authenticated",
                "status" => true,
                "token" => Auth::user()->createToken("easyshoptoken")->plainTextToken
            ]);
        }
        
        return response()->json([
            "status" => false,
            "message" => "Email and Password dont match."
        ]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        

        return response()->json([
            "message" => "Successfully Logged out",
            "status" => true

        ]);
    }


    public function register(Request $request){
         // validar datos
        $validator = validator()->make($request->all(), [
            "email" => ["required", "email", "unique:users,email"],
            "password" => "required",
            "name" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ]);
        }
        
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
        ]);

        return response()->json([
            "status"=> "true",
            "message"=>"sucessfullt fetched user data"
        ]);
        
    }

    public function getMe() {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                "status" => true,
                "user" => [
                    "name" => $user->name,
                    "email" => $user->email,
                    "createdAt" => $user->created_at,
                ]
            ]);
        }
    
        return response()->json([
            "status" => false,
            "message" => "User not authenticated"
        ], 401);
    }
}
