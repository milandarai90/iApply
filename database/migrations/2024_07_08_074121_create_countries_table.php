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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('consultancy_id');
            // $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('consultancy_id')->references('id')->on('consultancy_infos')->onDelete('cascade');
            // $table->foreign('branch_id')->references('id')->on('consultancy_branches')->onDelete('cascade');
            $table->string('country_map');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
