<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use Illuminate\Http\Request;
use App\Folder;
use App\Task;

class TaskController extends Controller
{
    public function index(int $id)
    {
        //全てのフォルダを取得する
        $folders = Folder::all();

        //選ばれたフォルダを取得する
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する
        $tasks = $current_folder->tasks()->get();


    return view('tasks/index', [
        'folders' => $folders,
        'current_folder' => $current_folder,
        'current_folder_id' => $current_folder->$id,
        'tasks' => $tasks,
    ]);
    }

    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
    ]);
}
}