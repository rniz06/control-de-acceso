<?php

namespace App\Services\Cda\Validaciones;

use App\Models\Cda\IngresoVehiculo;
use App\Models\Cda\Vehiculo;

class IngresoVehiculoService
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
    public static function tieneSalidaPendiente(string $chapa): bool
    {
        $vehiculo = Vehiculo::where('chapa', $chapa)->first();

        # Si no existe ningún vehículo con esa chapa, no puede haber un
        # ingreso pendiente asociado. Por eso devuelve false.
        if (!$vehiculo) {
            return false;
        }

        # Devuelve true si hay al menos un registro que cumple las condiciones, y false si no
        return IngresoVehiculo::where('vehiculo_id', $vehiculo->id)
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
    public static function intentaSalirSinIngreso(string $chapa): bool
    {
        $vehiculo = Vehiculo::where('chapa', $chapa)->first();

        // Si no existe el vehículo, entonces no pudo haber ingresado nunca.
        if (!$vehiculo) {
            return true; // intenta salir sin haber ingresado
        }

        // Buscamos si tiene un ingreso activo (sin salida registrada)
        $tieneIngresoActivo = IngresoVehiculo::where('vehiculo_id', $vehiculo->id)
            ->whereNull('fecha_hora_salida')
            ->exists();

        // Si NO tiene ingreso activo, entonces está intentando salir sin entrada
        return !$tieneIngresoActivo;
    }
}
