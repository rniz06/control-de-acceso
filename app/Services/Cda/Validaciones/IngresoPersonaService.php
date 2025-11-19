<?php

namespace App\Services\Cda\Validaciones;

use App\Models\Cda\IngresoPersona;
use App\Models\Cda\Persona;

class IngresoPersonaService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Verifica si un vehículo con la chapa dada tiene un ingreso sin salida.
     *
     * @param string $chapa
     * @return bool
     */
    public static function tieneSalidaPendiente(string $nro_cedula): bool
    {
        $persona = Persona::where('nro_cedula', $nro_cedula)->first();

        # Si no existe ningúna persona con ese nro_cedula, no puede haber un
        # ingreso pendiente asociado. Por eso devuelve false.
        if (!$persona) {
            return false;
        }

        # Devuelve true si hay al menos un registro que cumple las condiciones, y false si no
        return IngresoPersona::where('persona_ingresa_id', $persona->id)
            ->whereNull('fecha_hora_salida')
            ->exists();
    }

    /**
     * Verifica si un vehículo con la chapa dada intenta registrar salida sin haber ingresado antes.
     *
     * Devuelve true si NO existe ningún ingreso pendiente (es decir,
     * no hay registro de entrada activo o nunca ingresó).
     *
     * @param string $chapa
     * @return bool
     */
    public static function intentaSalirSinIngreso(string $nro_cedula): bool
    {
        $persona = Persona::where('nro_cedula', $nro_cedula)->first();

        // Si no existe la persona, entonces no pudo haber ingresado nunca.
        if (!$persona) {
            return true; // intenta salir sin haber ingresado
        }

        // Buscamos si tiene un ingreso activo (sin salida registrada)
        $tieneIngresoActivo = IngresoPersona::where('persona_ingresa_id', $persona->id)
            ->whereNull('fecha_hora_salida')
            ->exists();

        // Si NO tiene ingreso activo, entonces está intentando salir sin entrada
        return !$tieneIngresoActivo;
    }
}
