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
        Schema::create('control_acceso.CDA_INGRESO_VEHICULOS', function (Blueprint $table) {
            $table->id();

            // INGRESO
            $table->dateTime('fecha_hora_ingreso');
            $table->foreignId('vehiculo_id')->nullable()->constrained('control_acceso.CDA_VEHICULOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('persona_ingresa_id')->nullable()->constrained('control_acceso.CDA_PERSONAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('persona_visita_id')->nullable()->constrained('control_acceso.CDA_PERSONAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('acceso_ingreso_id')->nullable()->constrained('ACCESOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('usuario_registro_ingreso')->nullable()->references('id')->on('public.users')->cascadeOnUpdate()->cascadeOnDelete();

            //SALIDA
            $table->dateTime('fecha_hora_salida')->nullable();
            $table->foreignId('acceso_salida_id')->nullable()->constrained('ACCESOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('usuario_registro_salida')->nullable()->references('id')->on('public.users')->cascadeOnUpdate()->cascadeOnDelete();

            //OTROS
            $table->boolean('corresponde_salida')->nullable()->comment('CAMPO PARA MARCAR SI NO SE REGISTRO LA SALIDA DE LA PERSONA/VEHICULO');
            $table->foreignId('empresa_id')->nullable()->constrained('EMPRESAS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sucursal_id')->nullable()->constrained('SUCURSALES')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('img_entrada')->nullable();
            $table->string('img_salida')->nullable();
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
        Schema::dropIfExists('control_acceso.CDA_INGRESO_VEHICULOS');
    }
};
