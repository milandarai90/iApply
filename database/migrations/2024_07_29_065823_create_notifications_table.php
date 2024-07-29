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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sent_by');
            $table->unsignedBigInteger('sent_to');
            $table->foreign('sent_by')->references('id')->on('users')->onDelete('cascade'); // Corrected reference
            $table->foreign('sent_to')->references('id')->on('users')->onDelete('cascade'); // Corrected reference
            $table->string('notification');
            $table->enum("status",["read","unread"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
