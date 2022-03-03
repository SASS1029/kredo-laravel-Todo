@extends('layouts.app')

@section('title' , 'Edit')

@section('content')


    <h1 class="h4">Edit Task</h1>
                            <!--  routeのnameがupdateのところ -->
    <form action="{{route('update' , $task->id)}}" method="post" class="row mb-3">
        @csrf
        @method('PATCH') <!-- Laravelはpostしかデフォルト対応していないのでPATCH（update）とDELETE（delete）はこのメソッドディレクティブが必要 / postは必要ない-->

        <div class="col-10 pe-0">                                                               <!-- viewのtaskが$taskになって、taskカルムにアクセスしてる  -->
            <input type="text" name="task" placeholder="Edit task" class="form-control" value="{{ $task->task }}"> 
        </div>
        <div class="col-2">
            <button  type="submit" class="btn btn-primary w-100">Update</button>
        </div>
        @error('task')
            <p class="text-danger">{{$message}}</p>
        @enderror
    </form>  
@endsection