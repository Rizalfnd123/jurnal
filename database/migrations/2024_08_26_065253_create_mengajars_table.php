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
        Schema::create('mengajars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('jam_id')->constrained('jam')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('mapel_id')->constrained('mapel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('semeter_id')->constrained('semester')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tapel_id')->constrained('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('hari',100); 
            $table->enum('status', ['B', 'S','I'])->default('B');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mengajars');
    }
};
