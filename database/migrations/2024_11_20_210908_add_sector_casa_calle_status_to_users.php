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
        Schema::table('users', function (Blueprint $table) {
            $table->string('calle', 50)->nullable(); // Reemplaza 'existing_column' con el nombre de la última columna actual.
            $table->string('casa', 50)->nullable(); // Reemplaza 'existing_column' con el nombre de la última columna actual.
            $table->string('sector', 50)->nullable(); // Reemplaza 'existing_column' con el nombre de la última columna actual.
            $table->string('status', 27)->nullable(); // Reemplaza 'existing_column' con el nombre de la última columna actual.

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['calle', 'sector', 'status', 'casa']);
        });
    }
};
