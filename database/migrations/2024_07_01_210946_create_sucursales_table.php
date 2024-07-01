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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direccion_id')->constrained('direcciones')->cascadeOnDelete();
            $table->integer('nro_sucursal');
            $table->string('departamento');
            $table->longText('direccion_completa');
            $table->string('ciudad');
            $table->string('municipio');
            $table->boolean('en_operacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};
