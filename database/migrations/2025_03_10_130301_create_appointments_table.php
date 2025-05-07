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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->constrained()->cascadeOnDelete();
            $table->integer("doctor_id")->constrained()->cascadeOnDelete();
            $table->foreignId('availability_schedule_id')->constrained()->onDelete('cascade');
            $table->enum("status", ["booked", "completed", "canceled"])->default("booked");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
