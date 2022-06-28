<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 以下のやつ追加
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        // バリデーションで引っかかったらエラーを返す
        if ($validator->fails()) {
            return response()->json(
                $validator->messages(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // json返す
        $json = [
            'data' => $user,
            'message' => 'User registration success!',
            'error' => ''
        ];

        return response()->json( $json, Response::HTTP_OK);
    }
}
