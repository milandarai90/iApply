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
        Schema::create('country_guidelines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultancy_id');
            $table->unsignedBigInteger('country_id');
            $table->foreign('consultancy_id')->references('id')->on('consultancy_infos')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('guidelines');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_guidelines');
    }
};
