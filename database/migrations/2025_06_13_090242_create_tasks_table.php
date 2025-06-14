<?php

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->default('');
            $table->foreignIdFor(TaskStatus::class, 'status_id')
                ->constrained()
                ->restrictOnDelete();
            $table->foreignIdFor(User::class,'created_by_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class,'assigned_to_id')
                ->constrained()
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
