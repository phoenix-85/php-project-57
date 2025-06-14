<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_label_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('labels.create'));

        $response
            ->assertOk();
    }

    public function test_label_is_created(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('labels.store'), [
                'name' => 'TestName',
                'description' => 'TestDescription',
            ]);

        $response
            ->assertRedirect('labels');

        $response = $this
            ->get(route('labels.index'));

        $response
            ->assertSee('TestName');
    }
}
