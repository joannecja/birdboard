<?php

namespace Tests\Setup;

use App\User;
use App\Project;
use App\Task;

// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectFactory
{
    protected $tasksCount = 0;
    protected $user;

    public function withTasks($count=1)
    {
        $this->tasksCount = $count;
        return $this;
    }

    public function ownedby($user)
    {
        $this->user = $user;
        return $this;
    }

    public function create()
    {
        $project = factory(Project::class)->create([
            'owner_id' => $this->user ?? factory(User::class)
        ]);

        factory(Task::class, $this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}