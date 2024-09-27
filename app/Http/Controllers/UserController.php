<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserApiResource;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function post(Request $request){
        //validation rules
        $validator = Validator::make($request->all(),[
            'f_name' => 'required',
            'position' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required'
        ]
        );

        if($validator->fails()){
            return new UserApiResource(false,$validator->errors() ,[]);
        }

        //post
        $post = user::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'position' => $request->position,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return new UserApiResource(true,'Berhasil Input Data',$post);
    }
}
