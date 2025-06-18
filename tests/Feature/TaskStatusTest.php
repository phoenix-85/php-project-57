<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateTaskStatusPageIsDisplayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('task_statuses.create'));

        $response
            ->assertOk();
    }

    public function testTaskStatusIsCreated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('task_statuses.store'), [
                'name' => 'TestTaskStatus'
            ]);

        $response
            ->assertRedirect('task_statuses');

        $response = $this
            ->get(route('task_statuses.index'));

        $response
            ->assertSee('TestTaskStatus');
    }
}
