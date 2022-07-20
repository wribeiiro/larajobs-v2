<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('logo')->nullable();
            $table->string('tags');
            $table->string('company');
            $table->string('location')->default('remote');
            $table->string('email');
            $table->string('website');
            $table->longText('description');
            $table->enum('level', ['beginner', 'middle', 'experient']);
            $table->enum('contract', ['pj', 'clt', 'trainee']);
            $table->string('salary_range')->default('Negociável');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
