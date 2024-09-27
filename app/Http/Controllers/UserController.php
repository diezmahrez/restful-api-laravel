<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserApiResource;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function post(Request $request)
    {
        //validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required',
                'position' => 'required',
                'email' => 'required|email',
                'username' => 'required',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return new UserApiResource(false, $validator->errors(), null);
        }

        //post
        $data = user::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'position' => $request->position,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);
        
        return new UserApiResource(true, 'Berhasil Input Data', $data);
    }

    public function get($id)
    {
        $data = user::find($id);
        // dd($data);
        if (is_null($data)) {
            return new UserApiResource(false, 'Data tidak ditemukkan', $data);
        }
        return new UserApiResource(true, 'Detail Data User', $data);
    }

    public function put(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required',
                'position' => 'required',
                'email' => 'required|email'
            ]
        );

        if ($validator->fails()) {
            return new UserApiResource(false, $validator->errors(), null);
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'position' => $request->position,
            'email' => $request->email
        ];

        $update = user::find($id)->update($data);
        return new UserApiResource(true, 'Berhasil Update Data', $data);
    }
    public function delete($id){
        user::find($id)->delete();
        return new UserApiResource(true, 'Berhasil Delete Data', null);

    }
}
