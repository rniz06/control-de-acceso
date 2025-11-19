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
        Schema::create('control_acceso.CDA_PERSONAS', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo', 50);
            $table->string('nro_cedula', 15)->nullable();
            $table->string('nro_celular', 20)->nullable();
            $table->boolean('esPersonalEmpresa')->nullable();
            $table->foreignId('empresa_id')->nullable()->constrained('EMPRESAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sucursal_id')->nullable()->constrained('SUCURSALES')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('control_acceso.CDA_PERSONAS');
    }
};
