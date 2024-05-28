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
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('consultancy_name');
            $table->string('consultancy_email');
            $table->string('head_office_district');
            $table->string('head_office_municipality');
            $table->string('head_office_ward');
            $table->string('telphone_num')->nullable()->default(null);
            $table->string('pan_number');
            $table->string('head_person_idcard');
            $table->string('head_person_name');
            $table->string('head_person_number');
            $table->string('password');
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