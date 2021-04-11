<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Http\Request;
use App\Folder;
use App\Task;


class TaskController extends Controller
{
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function index(Folder $folder)
    {

        
        //ユーザーのフォルダを取得する。
        $folders = Auth::user()->folders()->get();

        // ------start 10章エラーハンドリング対応による対応で修正-------
        //全てのフォルダを取得する
        //$folders = Folder::all();

        //選ばれたフォルダを取得する
        // $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する
        // $tasks = $current_folder->tasks()->get();
        $tasks = $folder->tasks()->orderBy('status', 'asc')->get();
        // ------end 10章エラーハンドリング対応による対応で修正-------
        
        return view('tasks/index', [
            'folders' => $folders,
            // 'current_folder' => $current_folder,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }
    /**
     * タスク作成フォーム
     * @pram Folder $folder
     * @return \Illuminate\View\View
     */

    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request)
    {
        // $current_folder = Folder::find($id);

        // インスタンスを生成
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        //$current_folder->tasks()->save($task);

        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task_id
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder, Task $task_id)
    {
        // $this->checkRelation($folder, $task);

        // $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task_id,
        ]);
    }

    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit (Folder $folder, Task $task_id, EditTask $request)
    {
        // $this->checkRelation($folder, $task);


        $task = Task::find($task_id->id);


        $task-> title = $request->title;
        $task-> status = $request->status;
        $task->timestamps = false;
        $task->due_date = $request->due_date;

        $task->save();

        return redirect()->route('tasks.index',[
            'folder' => $task->folder_id,
        ]);
    }

    // private function checkRelation(Folder $folder, Task $task)
    // {
    //     if($folder->id !== $task->folder_id) {
    //         var_dump($folder->id);
    //         var_dump('hogehoge');
    //         var_dump($task->folder_id);
    //         exit;
    //         abort(404);
    //     }
    // }


}