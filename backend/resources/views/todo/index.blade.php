@extends('layouts.app')

@section('title' , 'Index')<!-- indexはブラウザのタグ名になる -->
@section('content')
    <h1 class="h4">Todo App</h1>

    <form action="{{route('store')}}" method="post" class="row mb-3">
        @csrf
        <div class="col-10 pe-0">
            <input  type="text" name="task" placeholder="Create a task" class="form-control">
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>
        @error('task')
            <p class="text-danger">{{$message}}</p>
        @enderror
    </form>

    @if($all_tasks->isNotEmpty())
    <ul class="list-group">
        @foreach($all_tasks as $task)
        <li class="list-group-item d-flex align-items-center">
            <div class="me-auto">
                {{$task->task}} <!--  task is column name-->
            </div>      
            <form action="{{route('destroy' , $task->id)}}" method="post">
                @csrf
                @method('DELETE')
                <!-- cross-site request forgeries
                      always attach csrf token in the form to validate the request  
                -->
                <a href="{{ route('edit' , $task->id) }}" class="btn btn-primary btn-sm" title="Edit"> <i class="fas fa-edit"></i></a>
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></button>
            </form>
            
        </li>
        @endforeach
    </ul>
    @endif

@endsection