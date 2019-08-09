@extends('layouts.app')

@section('content')

    <header class="d-flex align-items-center mb-3 py-4">
        <div class="d-flex justify-content-between w-100 align-items-end">
            <p class="text-secondary font-weight-normal">
                <a href="/projects" class="text-secondary text-decoration-none">My project</a>
            </p>
            <a class="btn btn-purple shadow-sm" href="projects/create">New Project</a>
        </div>
    </header>

    <main class="d-flex flex-wrap mx-n2">
		@forelse($projects as $project)

            <div class="w-33 px-2 pb-3">
                @include('projects.card')
            </div>

        @empty
            <div>Nothing here!</div>
		@endforelse
    </main>

@endsection
