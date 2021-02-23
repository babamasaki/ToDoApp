<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        //ログインユーザーを取得
        $user = Auth::user();

        //ログインユーザーに紐づくフォルダを一つ取得
        $folder = $user->folders()->first();

        //まだ一つもフォルダを作成していなければホームページをレスポンスする。
        if(is_null($folder)){
            return view('home');
        }
        
        //フォルダが一つでもあればタスク一覧にリダイレクトする。

        return redirect()->route('tasks.index',[
            'id' => $folder->id,
        ]);
    }
}
