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
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('role');
            $table->foreign('role')->references('id')->on('roles')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('consultancy_id')->nullable();
            $table->foreign('consultancy_id')->references('id')->on('consultancy_infos')->onDelete('cascade');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('consultancy_branches')->onDelete('cascade');
            $table->string('phone')->unique()->nullable();
            $table->string('u_district')->nullable();
            $table->string('u_municipality')->nullable();
            $table->string('u_ward')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
