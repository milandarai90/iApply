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
        Schema::create('consultancy_infos', function (Blueprint $table) {
            $table->id();
            $table->string('telphone_num')->nullable()->default(null);
            $table->string('pan_number')->unique();
            $table->string('head_person_idcard');
            $table->string('head_person_fullname');
            $table->string('head_person_number')->unique();
            $table->string('valid_document');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultancy_infos');
    }
};
