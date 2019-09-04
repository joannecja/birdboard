<?php

namespace Tests\Unit;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function itBelongsToAProject()
    {
    	$task = factory('App\Task')->create();
        $this->assertInstanceOf('App\Project', $task->project);
    }

    /** @test */
    public function itHasAPath()
    {
    	$task = factory('App\Task')->create();
    	$this->assertEquals('/projects/'. $task->project->id . '/tasks/' . $task->id, $task->path());
    }
}
