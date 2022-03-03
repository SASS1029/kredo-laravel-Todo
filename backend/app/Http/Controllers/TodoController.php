<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    private $todo;
                            //$todo = new Todo(Model)
    public function __construct(Todo $todo) {
        $this->todo = $todo;  
    }

    #Read All
    public function index() {
        $all_tasks = $this->todo->latest()->get();
        //latest() ... order the results by date
        return view('todo.index')
                ->with('all_tasks' , $all_tasks);
    }

    #Create / Insert
    public function store(Request $request) {
        // $request contains all the data from the form

        $request->validate([//errorメッセージとセット　　index.blade.php @error('task') <p class="text-danger">{{$message}}</p>@enderror
            'task'=>'required|min:1|max:50'
        ]);

        $this->todo->task = $request->task;
        $this->todo->save();

        return redirect()->back();
        //back() redirects the user back to its previous location
    }

    public function edit($id) {  //editアクションは、編集するモデルを特定し、編集された内容を受け取り、updateアクションに内容を送信します 一方、updateアクションは、editアクションから受け取った内容を元にデータベースを書き換えます。
        $task = $this->todo->findOrFail($id);

        return view('todo.edit')//todoフォルダのedit.blade.phpへ
                ->with('task' , $task);
    }

    public function update($id , Request  $request) {
        $request->validate([
            'task'=>'required|min:1|max:50'
        ]);
    

    $task = $this->todo->findOrFail($id);
    //SELECT*FROM todos WHERE id = $id

    $task->task = $request->task;
    $task->save();

    return redirect()->route('index');

    }

    public function destroy($id) {
        $this->todo->destroy($id);

        return redirect()->back();
    }
        
    
}
