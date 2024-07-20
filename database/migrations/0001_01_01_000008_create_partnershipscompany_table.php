<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnershipsCompanyTable extends Migration
{
    public function up()
    {
        Schema::create('company_partnership', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('partnership_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Optional: Composite unique constraint to prevent duplicate entries
            $table->unique(['company_id', 'partnership_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_partnership');
    }
}
