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
        Schema::create('shared_documents', function (Blueprint $table) {
            $table->id();
            $table->integer("patient_id")->constrained()->cascadeOnDelete();
            $table->integer("doctor_detail_id")->constrained()->cascadeOnDelete();
            $table->string("document_path");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_documents');
    }
};
