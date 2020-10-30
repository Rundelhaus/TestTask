<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('Cascade');
            $table->integer('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('Cascade');
            $table->integer('mark');
            $table->integer('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('Cascade');
            $table->date('get_date');
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
        Schema::dropIfExists('marks');
    }
}
