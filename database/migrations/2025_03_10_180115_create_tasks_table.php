<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assigned_to');
            $table->unsignedBigInteger('created_by');
            $table->string('task_name');
            $table->text('task_description')->nullable();
            $table->date('task_start_date');
            $table->date('task_end_date');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
