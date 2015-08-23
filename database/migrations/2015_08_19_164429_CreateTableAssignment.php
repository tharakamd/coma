<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAssignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!(Schema::hasTable('assignment'))) {


            Schema::create('assignment', function (Blueprint $table) {

                $table->string('assignment_id');
                $table->string('name');
                $table->integer('user_id')->unsigned();
                $table->string('course_id');

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
        Schema::table('assignment', function (Blueprint $table) {
            Schema::drop('assignment');
        });
    }
}
