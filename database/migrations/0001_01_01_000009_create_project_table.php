<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class  CreateProjectTable  extends Migration
{
    /**
     * Run the migrations.
     */
     
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->string('project_id')->primary(); // Primary key
            $table->string('project_name');
            $table->string('partnership_id'); // Foreign key for partnership (assuming this is another table)
            $table->foreignId('project_manager')->constrained('users')->onDelete('cascade'); // Foreign key for project manager
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date')->nullable(); // End date is nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
