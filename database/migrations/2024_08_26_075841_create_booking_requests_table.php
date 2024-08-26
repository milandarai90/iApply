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
        Schema::create('booking_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');
            $table->unsignedBigInteger('consultancy_id');
            $table->foreign('consultancy_id')->references('id')->on('consultancy_infos')->ondelete('cascade');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('consultancy_branches')->ondelete('cascade');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->ondelete('cascade');
            $table->unsignedBigInteger('classroom_id');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->ondelete('cascade');
            $table->enum("status",["book","canceled","rejected","null"])->default('null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_requests');
    }
};
