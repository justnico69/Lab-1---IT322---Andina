<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('parents', function (Blueprint $table) {
            $table->id(); // Creates 'id' as PRIMARY KEY (bigint unsigned auto-increment)
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('parents');
    }
};

