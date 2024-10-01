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
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurnals_id')->constrained('jurnals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('siswas_id')->constrained('siswas')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('ket', ['aktif', 'tidak aktif']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absens');
    }
};
