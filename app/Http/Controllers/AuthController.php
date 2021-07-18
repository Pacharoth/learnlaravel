<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    //
    public function register(Request $request){
        $fields = $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|string|unique:users,email',
            'password'=>'required|string|confirmed',
        ]);
        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),
        ]);
        $token = $user->createToken('token')->plainTextToken;
        $response =[
            'user'=>$user,
            'token'=>$token,
        ];
        return response($response,200);
    }
    public function login(Request $request){
        $fields=$request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        //check email
        $user = User::where('email',$fields['email'])->first();
        if(!$user||!Hash::check($fields['password'], $user->password)){
            return response([
                'message'=>'Bad credentials'
            ]);
        }
        $token = $user->createToken('token')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token,
        ];
        return response($response,200);
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return [
            'message'=>'logout'
        ];
    }
}
