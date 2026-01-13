<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('beats', function (Blueprint $table) {
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('beats', 'audio_path')) {
                $table->string('audio_path')->after('description');
            }
            if (!Schema::hasColumn('beats', 'genre')) {
                $table->string('genre')->nullable()->after('audio_path');
            }
            if (!Schema::hasColumn('beats', 'bpm')) {
                $table->integer('bpm')->nullable()->after('genre');
            }
        });
    }

    public function down()
    {
        Schema::table('beats', function (Blueprint $table) {
            $table->dropColumn(['audio_path', 'genre', 'bpm']);
        });
    }
};
