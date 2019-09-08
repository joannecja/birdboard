@extends('layouts.app')

@section('content')

    <header class="d-flex align-items-center mb-3 py-4">
        <div class="d-flex justify-content-between w-100 align-items-end">
            <p class="text-secondary font-weight-normal">
                <a href="/projects" class="text-secondary text-decoration-none">My project</a> / Create a project
            </p>
        </div>
    </header>

    <main>
        <div class="d-flex">
            <div class="w-100">
                <form method="POST" action="/projects">
                    @csrf

                    <div class="form-group">
                        <label class="label" for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label class="label" for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create Project</button>
                        <a href="/projects">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
