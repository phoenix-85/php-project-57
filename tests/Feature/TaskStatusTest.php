<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_task_status_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('task_statuses.create'));

        $response
            ->assertOk();
    }

    public function test_task_status_is_created(): void
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
