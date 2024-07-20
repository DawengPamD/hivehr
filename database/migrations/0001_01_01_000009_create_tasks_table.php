<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->string('task_id')->primary(); // Primary key
            $table->string('project_id'); // Foreign key for project
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('due_date');
            $table->string('status');
            $table->string('priority');
            $table->timestamps();

            // Foreign key constraint for project_id
            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
