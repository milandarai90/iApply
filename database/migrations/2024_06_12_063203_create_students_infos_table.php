<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('consultancy_branches')->onDelete('cascade');
            $table->unsignedBigInteger('consultancy_id')->nullable();
            $table->foreign('consultancy_id')->references('id')->on('consultancy_Infos')->onDelete('cascade');
            $table->unsignedBigInteger('classroom_id')->nullable();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('joining_date');
            $table->string('completed_date')->nullable();
            $table->enum('joined_type', ["online", "physical"]);
            $table->enum('status', ["booked", "joined", "completed"]);
            // $table->enum('activity', ["active", "inactive"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_infos');
    }
};
