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

    public function onlyTheOwnerCanAddTasksToProject()
    {
        $this->signIn();

        $project = factory('App\Project')->create();
        $this->post($project->path() .'/tasks', ['body' => 'Twkjfpe werwr'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Twkjfpe werwr']);
    }

    public function onlyTheOwnerCanUpdateTasks()
    {
        $this->signIn();

        $project = factory('App\Project')->create();
        $task = $project->addTask('test task');

        $this->patch($project->path().'/tasks/'.$task->id, ['body' => 'Twkjfpe werwr'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Twkjfpe werwr']);
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
    public function tasksCanbeUpdated()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory('App\Project')->raw()
        );

        $task = $project->addTask('test task');
        $this->patch($project->path().'/tasks/'.$task->id, [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
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
