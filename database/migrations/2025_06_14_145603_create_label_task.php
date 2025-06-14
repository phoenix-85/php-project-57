<?php

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('label_task', function (Blueprint $table) {
            $table->foreignIdFor(Label::class, 'label_id')
                ->constrained()
                ->restrictOnDelete();
            $table->foreignIdFor(Task::class,'task_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('label_task');
    }
};
