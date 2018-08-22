<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_tasks', function (Blueprint $table) {
            $table->increments('tag_task_id');
            $table->integer('tag_id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->timestamps();

            // $table->foreign('tag_id')->references('tag_id')->on('tags');
            // $table->foreign('task_id')->references('task_id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tag_tasks');
    }
}
