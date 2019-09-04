@extends('layouts.app')

@section('content')

    <header class="d-flex align-items-center mb-3 py-4">
        <div class="d-flex justify-content-between w-100 align-items-end">
            <p class="text-secondary font-weight-normal">
                <a href="/projects" class="text-secondary text-decoration-none">My project</a> / {{ $project->title }}
            </p>
            <a class="btn btn-purple shadow-sm" href="projects/create">New Project</a>
        </div>
    </header>


    <main>
        <div class="d-flex mx-n3">
            <div class="w-75 px-3">
                {{-- Tasks --}}
                <div class="mb-5">
                    <h4 class="text-secondary font-weight-normal">Tasks</h4>
                    @foreach($project->tasks as $task)
                        <div class="bg-white p-3 rounded-lg shadow-sm mb-3">
                            <form action="{{$task->path()}}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="d-flex">
                                    <input class="w-100 {{$task->completed ? 'text-gray': ''}}"
                                        style="border:none; outline: none; {{$task->completed ? 'text-decoration:line-through;': ''}}"
                                        name="body" value="{{$task->body}}">
                                    <input type="checkbox" name="completed"
                                        {{$task->completed ? 'checked': ''}}
                                        onchange="this.form.submit();">
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="bg-white p-3 rounded-lg shadow-sm mb-3">
                        <form action="{{$project->path()}}/tasks" method="POST">
                            @csrf
                            <input class="w-100" style="border:none; outline: none;"
                                name="body" placeholder="Add a new task..." >
                        </form>
                    </div>
                </div>

                {{-- General Notes --}}
                <div class="mb-5">
                    <h4 class="text-secondary font-weight-normal">General Notes</h4>
                    <textarea class="bg-white p-3 rounded-lg shadow-sm w-100" style="min-height: 200px;">
                    </textarea>
                </div>
            </div>

            <div class="w-25 px-3">
                @include('projects.card')
                <a href="/projects">Go Back</a>
            </div>

        </div>
    </main>



@endsection
