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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Sender (Doctor or Patient)
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // Receiver (Doctor or Patient)
            $table->text('description')->nullable(); // Optional description
            $table->boolean('is_saved')->default(false); // Whether the patient saved it
            $table->boolean('is_vued')->default(false); // Whether the patient saved it
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
