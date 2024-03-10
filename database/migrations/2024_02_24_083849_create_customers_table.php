<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->min(2)->max(20);
            $table->string('last_name')->min(3)->max(20);
            $table->string('middle_name')->nullable();
            //$table->enum('gender', ['male', 'female', 'none'])->default('none');
            $table->string('email')->unique();
            $table->string('phoneNumber', 12)->unique();
            $table->enum('status', ['left_a_request', 'active', 'inactive'])->default('left_a_request');
            $table->unsignedInteger('feedbacks_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
