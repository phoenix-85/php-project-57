<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_task_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('tasks.create'));

        $response
            ->assertOk();
    }

    public function test_task_is_created(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('tasks.store'), [
                'name' => 'Brunswick',
                'description' => 'Habahaba',
                'status_id' => 1,
                'assigned_to_id' => $user->id,
            ]);

        $response
            ->assertRedirect(route('tasks.index'));

        $response = $this
            ->get(route('tasks.index'));

        $response
            ->assertSee([
                'Brunswick',
                'Habahaba',
                $user->name,
            ]);
    }
}
