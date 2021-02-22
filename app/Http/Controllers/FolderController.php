<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;


class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        //フォルダモデルのインスタンスを生成
        $folder = new Folder();
        //titleに値を代入
        $folder->title = $request->title;

        //ユーザーに紐付けて保存
        Auth::uer()->folders()->seve($folder);

        //インスタンスの状態をデータベースに書き込む
        $folder->save();

        return redirect()->route('tasks.index',['id' => $folder->id,
        ]);
    }
}
