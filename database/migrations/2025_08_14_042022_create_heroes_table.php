<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    // Ubah 'heros' menjadi 'heroes'
    Schema::create('heroes', function (Blueprint $table) { 
        $table->id();
        $table->string('title')->nullable();
        $table->text('subtitle')->nullable();
        $table->string('background_image');
        $table->string('button_text')->nullable();
        $table->string('button_link')->nullable();
        $table->integer('order')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
