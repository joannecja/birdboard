<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;

class ProjectsTasksController extends Controller
{

    public function store(Project $project)
    {
    	if(auth()->user()->isNot($project->owner)){
    		abort();
    	}

    	request()->validate(['body' => 'required']);

    	$project->addTask(request('body'));
    	return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
    	$task->update([
    		'body' => request('body'),
    		'completed' => request()->has('completed'),
    	]);

    	return redirect($project->path());
    }
}
