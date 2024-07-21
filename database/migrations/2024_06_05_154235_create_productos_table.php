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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marcas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nombre');
            $table->string('enlace');
            $table->json('imagenes')->nullable();
            $table->longText('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->boolean('disponible')->default(false);
            $table->integer('cantidad_disponible');
            $table->boolean('en_oferta')->default(false);
            $table->decimal('porcentaje_oferta', 10, 4)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
