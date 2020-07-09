<?php

namespace Tests\Setup;

use App\Project;
use App\User;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectFactory
{

    public function create()
    {
        factory(Project::class)->create([
            'owner_id' => factory(User::class)
        ]);
    }

    public function withTasks($count=1)
    {
        # code...
    }
}