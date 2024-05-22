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
        Schema::create('consultancy_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultancy_id');
            $table->foreign('consultancy_id')->references('id')->on('consultancy_infos')->onDelete('cascade');
            $table->string('branch_name');
            $table->string('branch_address');
            $table->string('branch_contact');
            $table->string('branch_manager');
            $table->string('branch_email');
            $table->string('branch_valid_document');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultancy_branches');
    }
};
