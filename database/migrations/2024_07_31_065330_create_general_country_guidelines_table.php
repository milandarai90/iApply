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
        Schema::create('general_country_guidelines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('generalcountry_id');
            $table->foreign('generalcountry_id')->references('id')->on('general_countries')->ondelete('cascade');
            $table->string('guidelines');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_country_guidelines');
    }
};
