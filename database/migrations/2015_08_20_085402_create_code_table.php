<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!(Schema::hasTable('code'))){
            Schema::create('code', function (Blueprint $table) {
                $table->increments('code_id');
                $table->string('name');
                $table->string('type');
                $table->string('status');
                $table->double('marks');
                $table->string('assignment_id');
                $table->string('course_id');
                $table->integer('user_id')->unsigned();

                $table->primary(['course_id', 'user_id', 'assignment_id']);
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('code');
    }
}
