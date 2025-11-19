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
        Schema::create('control_acceso.CDA_VEHICULOS', function (Blueprint $table) {
            $table->id();
            $table->string('chapa', 15);
            $table->foreignId('marca_id')->nullable()->references('id')->on('control_acceso.CDA_MARCAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('modelo_id')->nullable()->references('id')->on('control_acceso.CDA_MODELOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('color_id')->nullable()->references('id')->on('control_acceso.CDA_COLORES')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('creado_por')->nullable()->references('id')->on('public.users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('actualizado_por')->nullable()->references('id')->on('public.users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_acceso.CDA_VEHICULOS');
    }
};
