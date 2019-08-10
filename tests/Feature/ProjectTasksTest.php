<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
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
        $this->post($project->path() .'/tasks')->assertRedirect('login');
    }

    /** @test */
    public function projectCanHaveTasks()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory('App\Project')->raw()
        );
        //or
        //$project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->post($project->path() .'/tasks', ['body' => 'Twkjfpe werwr']);
        $this->get($project->path())->assertSee('Twkjfpe werwr');
    }

    /** @test */
    public function projectsRequireBody()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory('App\Project')->raw()
        );

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path().'/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
