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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('action'); // CREATE, UPDATE, DELETE, LOGIN, LOGOUT
            $table->string('model')->nullable(); // Model yang diubah (Berita, Galeri, dll)
            $table->unsignedBigInteger('model_id')->nullable(); // ID dari model yang diubah
            $table->text('description'); // Deskripsi aktivitas
            $table->json('old_values')->nullable(); // Nilai lama sebelum perubahan
            $table->json('new_values')->nullable(); // Nilai baru setelah perubahan
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'created_at']);
            $table->index(['action', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
