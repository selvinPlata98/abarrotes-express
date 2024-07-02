<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('sub_total', 10,2);
            $table->decimal('total_final', 10,2);
            $table->string('metodo_pago');
                $table->enum('estado_pago', ['pagado', 'procesando', 'error'])->nullable();
            $table->enum('estado_entrega', ['nuevo', 'procesado', 'enviado', 'entregado', 'cancelado']);
            $table->string('costos_envio');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
