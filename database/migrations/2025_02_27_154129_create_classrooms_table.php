<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateClassroomsTable extends Migration
{
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->unsignedBigInteger('grade_id');
            $table->char('section', 2);
            $table->boolean('status');
            $table->string('remarks', 45)->nullable();
            $table->unsignedBigInteger('teacher_id');
            $table->timestamps();
        
            // Foreign keys
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::table('classroom_students', function (Blueprint $table) {
            $table->dropForeign('classroom_students_classroom_id_foreign');
        });

        Schema::dropIfExists('classrooms');
    }
}
