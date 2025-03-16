<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            // Reference to the student (from the students table)
            $table->unsignedBigInteger('student_id');
            // Reference to the subject (from the subjects table)
            $table->unsignedBigInteger('subject_id');
            // Grade value, for example out of 100, with decimals if needed
            $table->decimal('grade', 5, 2);
            $table->string('semester');
            $table->string('school_year');
            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onDelete('cascade');
            $table->foreign('subject_id')
                ->references('id')->on('subjects')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
