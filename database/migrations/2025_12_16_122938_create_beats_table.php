<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beats', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('audio_path');  
    $table->string('genre')->nullable();
    $table->integer('bpm')->nullable();
    $table->decimal('price', 8, 2)->nullable();
    $table->boolean('is_sold')->default(false);
    $table->integer('play_count')->default(0);
    $table->timestamps();
    $table->softDeletes();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('beats');
    }
};
