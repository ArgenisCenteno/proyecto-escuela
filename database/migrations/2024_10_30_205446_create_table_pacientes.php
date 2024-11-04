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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento');
            $table->string('cedula')->nullable()->unique();
            $table->float('estatura')->nullable();
            $table->string('tipo_sangre', 3);
            $table->string('lateralidad');
            $table->boolean('posee_discapacidad')->default(false);
            $table->text('nota')->nullable();
            $table->foreignId('representante_id')->constrained('representantes')->onDelete('cascade');
            $table->string('colegio')->nullable();
            $table->string('grado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
