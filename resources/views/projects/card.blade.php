<div class="bg-white p-3 rounded-lg shadow-sm" style="height: 200px;">
    <h4 class="font-weight-normal py-2 ml-n3 mb-4 text-reset border-left-1 border-purple pl-3">
        <a class="text-dark text-decoration-none" href="{{ $project->path() }}">{{ $project->title }}</a>
    </h4>
    <div class="text-secondary">{{ str_limit($project->description, 100) }}</div>
</div>