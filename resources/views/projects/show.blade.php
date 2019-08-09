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
                    <div class="bg-white p-3 rounded-lg shadow-sm mb-3">Twkjfpe werwr</div>
                    <div class="bg-white p-3 rounded-lg shadow-sm mb-3">Twkjfpe werwr</div>
                    <div class="bg-white p-3 rounded-lg shadow-sm mb-3">Twkjfpe werwr</div>
                    <div class="bg-white p-3 rounded-lg shadow-sm">Twkjfpe werwr</div>
                </div>

                {{-- General Notes --}}
                <div class="mb-5">
                    <h4 class="text-secondary font-weight-normal">General Notes</h4>
                    <textarea class="bg-white p-3 rounded-lg shadow-sm w-100" style="min-height: 200px;">Csdwer wermr eovienpcx</textarea>
                </div>
            </div>

            <div class="w-25 px-3">
                @include('projects.card')
                <a href="/projects">Go Back</a>
            </div>

        </div>
    </main>



@endsection
