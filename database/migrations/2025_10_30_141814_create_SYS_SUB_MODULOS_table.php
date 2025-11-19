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
        Schema::create('SYS_SUB_MODULOS', function (Blueprint $table) {
            $table->id();
            $table->string('sub_modulo', 50);
            $table->foreignId('modulo_id')->constrained('SYS_MODULOS')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SYS_SUB_MODULOS');
    }
};
