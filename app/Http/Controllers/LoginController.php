<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//以下より追加
//-----------------------------------
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use \Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //ログイン処理
        if (Auth::attempt($credentials)) {
            //ユーザーを見つける
            $user = User::whereEmail($request->email)->first();

            // 古いトークンを消す
            $user->tokens()->delete();

            // 新規トークン発行
            $token = $user->createToken("login:user{$user->id}")
            ->plainTextToken;

            return response()->json(['token' => $token],Response::HTTP_OK);
        }

        // ログイン失敗時の処理
        return response()->json('Can Not Login', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
