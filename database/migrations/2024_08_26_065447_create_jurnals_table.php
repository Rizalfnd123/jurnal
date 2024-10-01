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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menagajars_id')->constrained('mengajars')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tapel_id')->constrained('tapel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('mapel_id')->constrained('mapel')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->string('materi');
            $table->string('dokumentasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
