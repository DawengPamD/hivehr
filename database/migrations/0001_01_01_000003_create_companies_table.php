<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('industry')->nullable();
            $table->string('size')->nullable();
            $table->string('address')->nullable();
            $table->decimal('rating', 2, 1)->default(0.0)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
    }

    /****/

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
