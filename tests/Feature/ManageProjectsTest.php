<?php

namespace Tests\Feature;

use App\Task;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function guestsCannotManageProjects()
    {
        $project = factory('App\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    /** @test */
    public function userCanCreateProject()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => $this->faker->paragraph,
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();
        $response->assertRedirect($project->path());
        $this->assertDatabaseHas('projects', $attributes);



        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function userCanUpdateProject()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $attributes = [
            'notes' => $this->faker->paragraph,
        ];


        $this->patch($project->path(), $attributes)->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function userCanViewProject()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee(str_limit($project->description,100));
    }

    /** @test */
    public function userCanNotViewProjectsOfOthers()
    {
        $this->signIn();
        $project = factory('App\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function userCanNotUpdateProjectsOfOthers()
    {
        $this->signIn();
        $project = factory('App\Project')->create();

        $this->patch($project->path(), [])->assertStatus(403);
    }

    /** @test */
    public function projectsRequireTitles()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function projectsRequireDescriptions()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
