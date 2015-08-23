<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!(Schema::hasTable('course'))) {


            Schema::create('course', function (Blueprint $table) {

                $table->string('course_id');
                $table->string('name');
                $table->integer('user_id')->unsigned();

                $table->primary(['course_id', 'user_id']);


                //  $table->foreign('user_id')->references('users')->on('id');

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
        Schema::table('course', function (Blueprint $table) {
           Schema::drop('course');
        });
    }
}
