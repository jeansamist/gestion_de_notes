<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // Each student is associated with a user
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('matricule')->unique();
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('class');
            $table->string('profile_photo')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
