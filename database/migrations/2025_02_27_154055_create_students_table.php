<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Creates 'id' as PRIMARY KEY (bigint unsigned auto-increment)
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fname');
            $table->string('lname');
            $table->date('dob');
            $table->string('phone', 15)->nullable();
            $table->string('mobile', 15)->nullable();
            $table->date('date_of_join');
            $table->boolean('status')->default(1);
            $table->date('last_login_date')->nullable();
            $table->string('last_login_ip', 45)->nullable();
            $table->timestamps();

            // Foreign Key Constraint (Ensures data type matches `parents.id`)
            $table->unsignedBigInteger('parent_id')
      ->nullable()
      ->constrained('parents')
      ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            if ($table->hasForeign('students_parent_id_foreign')) {
                $table->dropForeign('students_parent_id_foreign');
            }
        });
    
        Schema::dropIfExists('parents');
    }
};