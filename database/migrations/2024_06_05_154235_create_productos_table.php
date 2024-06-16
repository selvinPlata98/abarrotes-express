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
            $table->foreignId('marca_id')->constrained('marcas')->cascadeOnDelete();
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('enlace');
            $table->json('images')->nullable();
            $table->longText('descripcion');
            $table->decimal('precio', 10, 2);
            $table->boolean('disponible');
            $table->integer('cantidad_disponible');
            $table->boolean('en_oferta');
            $table->decimal('porcentaje_oferta', 3, 2);
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
