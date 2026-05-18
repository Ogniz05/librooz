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
    Schema::table('Utente', function (Blueprint $table) {
        // Aggiungiamo i campi per i percorsi delle immagini
        $table->string('avatar_path')->nullable();
        $table->string('banner_path')->nullable();
    });
}

public function down(): void
{
    Schema::table('Utente', function (Blueprint $table) {
        $table->dropColumn(['avatar_path', 'banner_path']);
    });
}
};
