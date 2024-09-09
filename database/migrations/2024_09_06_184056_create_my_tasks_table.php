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
        Schema::create('my_tasks', function (Blueprint $table) {
            $table->id('task_id');
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->dateTime('due_date');
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('created_on')->nullable();
            $table->timestamp('updated_on')->nullable();         
               $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_tasks');
    }
};
