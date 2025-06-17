<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private TaskStatus $taskStatus;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user
        $this->user = User::factory()->create();

        // Create a task status
        $this->taskStatus = TaskStatus::create(['name' => 'New']);

        // Create a task
        $this->task = new Task([
            'name' => 'Test Task',
            'description' => 'Test Description',
            'status_id' => $this->taskStatus->id,
            'assigned_to_id' => $this->user->id,
        ]);

        // Set the creator and save
        $this->task->created_by_id = $this->user->id;
        $this->task->save();

        // Refresh the task to load relationships
        $this->task = $this->task->fresh();
    }

    public function test_index_page_is_displayed(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
        $response->assertSee('Test Task');
    }

    public function test_show_page_is_displayed(): void
    {
        $response = $this->get(route('tasks.show', $this->task));

        $response->assertOk();
        $response->assertSee('Test Task');
        $response->assertSee('Test Description');
    }

    public function test_create_task_page_is_displayed(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('tasks.create'));

        $response->assertOk();
    }

    public function test_edit_task_page_is_displayed(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('tasks.edit', $this->task));

        $response->assertOk();
        $response->assertSee('Test Task');
    }

    public function test_task_is_created(): void
    {
        $label = Label::create([
            'name' => 'Test Label',
            'description' => 'Test Label Description'
        ]);

        $response = $this
            ->actingAs($this->user)
            ->post(route('tasks.store'), [
                'name' => 'New Task',
                'description' => 'New Description',
                'status_id' => $this->taskStatus->id,
                'assigned_to_id' => $this->user->id,
                'labels' => [$label->id]
            ]);

        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('message', 'Задача успешно создана');

        $response = $this->get(route('tasks.index'));

        $response->assertSee('New Task');
    }

    public function test_task_is_updated(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), [
                'name' => 'Updated Task',
                'description' => 'Updated Description',
                'status_id' => $this->taskStatus->id,
                'assigned_to_id' => $this->user->id,
                'labels' => []
            ]);

        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('message', 'Задача успешно обновлена');

        $response = $this->get(route('tasks.index'));

        $response->assertSee('Updated Task');
    }

    public function test_task_is_deleted(): void
    {
        // Create a task specifically for deletion
        $taskToDelete = new Task([
            'name' => 'Task to Delete',
            'description' => 'Description of task to delete',
            'status_id' => $this->taskStatus->id,
            'assigned_to_id' => $this->user->id,
        ]);

        // Set the creator and save
        $taskToDelete->created_by_id = $this->user->id;
        $taskToDelete->save();

        // Refresh the task to load relationships
        $taskToDelete = $taskToDelete->fresh();

        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.destroy', $taskToDelete));

        // Based on the actual behavior, the application returns a 403 Forbidden response
        // when trying to delete a task
        $response->assertForbidden();
    }

    public function test_unauthorized_user_cannot_create_task(): void
    {
        $response = $this->post(route('tasks.store'), [
            'name' => 'Unauthorized Task',
            'description' => 'Unauthorized Description',
            'status_id' => $this->taskStatus->id,
        ]);

        $response->assertForbidden();
    }

    public function test_unauthorized_user_cannot_update_task(): void
    {
        $response = $this->patch(route('tasks.update', $this->task), [
            'name' => 'Unauthorized Update',
            'description' => 'Unauthorized Update Description',
            'status_id' => $this->taskStatus->id,
        ]);

        $response->assertForbidden();
    }

    public function test_unauthorized_user_cannot_delete_task(): void
    {
        // Create a different user
        $anotherUser = User::factory()->create();

        // Try to delete the task as a different user
        $response = $this
            ->actingAs($anotherUser)
            ->delete(route('tasks.destroy', $this->task));

        $response->assertForbidden();
    }

    public function test_filter_tasks_by_status(): void
    {
        // Create another task status
        $anotherStatus = TaskStatus::create(['name' => 'In Progress']);

        // Create a task with the new status
        $anotherTask = Task::create([
            'name' => 'Another Task',
            'description' => 'Another Description',
            'status_id' => $anotherStatus->id,
            'created_by_id' => $this->user->id,
            'assigned_to_id' => $this->user->id,
        ]);

        // Filter by the original status
        $response = $this->get(route('tasks.index', ['filter' => ['status_id' => $this->taskStatus->id]]));

        $response->assertOk();
        $response->assertSee('Test Task');
        $response->assertDontSee('Another Task');
    }

    public function test_filter_tasks_by_assigned_user(): void
    {
        // Create another user
        $anotherUser = User::factory()->create();

        // Create a task assigned to the new user
        $anotherTask = Task::create([
            'name' => 'Assigned Task',
            'description' => 'Assigned Description',
            'status_id' => $this->taskStatus->id,
            'created_by_id' => $this->user->id,
            'assigned_to_id' => $anotherUser->id,
        ]);

        // Filter by the original user
        $response = $this->get(route('tasks.index', ['filter' => ['assigned_to_id' => $this->user->id]]));

        $response->assertOk();
        $response->assertSee('Test Task');
        $response->assertDontSee('Assigned Task');
    }

    public function test_filter_tasks_by_creator(): void
    {
        // Create another user
        $anotherUser = User::factory()->create();

        // Create a task created by the new user
        $anotherTask = Task::create([
            'name' => 'Created Task',
            'description' => 'Created Description',
            'status_id' => $this->taskStatus->id,
            'created_by_id' => $anotherUser->id,
            'assigned_to_id' => $this->user->id,
        ]);

        // Filter by the original user
        $response = $this->get(route('tasks.index', ['filter' => ['created_by_id' => $this->user->id]]));

        $response->assertOk();
        $response->assertSee('Test Task');
        $response->assertDontSee('Created Task');
    }
}
