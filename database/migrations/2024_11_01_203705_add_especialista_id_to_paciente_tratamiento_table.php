<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('paciente_tratamiento', function (Blueprint $table) {
            $table->unsignedBigInteger('especialista_id')->nullable()->after('tratamiento_id');
            $table->foreign('especialista_id')->references('id')->on('especialistas')->onDelete('set null');
            $table->enum('estatus', ['En proceso', 'Cancelado', 'Completado'])->default('En proceso');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paciente_tratamiento', function (Blueprint $table) {
            $table->dropForeign(['especialista_id']);
            $table->dropColumn('especialista_id');
            $table->dropColumn('estatus');
        });
    }
};
