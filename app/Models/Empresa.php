<?php

namespace App\Models;

use App\Models\Cda\IngresoVehiculo;
use App\Models\Cda\Persona;
use App\Models\Compras\Compra;
use App\Models\Compras\Pedido;
use App\Models\Productos\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Empresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'EMPRESAS';

    protected $fillable = ['empresa', 'razon_social', 'ruc', 'correo', 'direccion', 'telefono', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function personas()
    {
        return $this->hasMany(Persona::class, 'empresa_id');
    }

    public function accesos()
    {
        return $this->hasMany(Acceso::class, 'empresa_id');
    }

    public function ingresos()
    {
        return $this->hasMany(IngresoVehiculo::class, 'empresa_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */

    /*
    |---------------------------------------
    | RELACIONES DE AUDITORIA DE LA TABLA
    |---------------------------------------
    */
    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function actualizadoPor()
    {
        return $this->belongsTo(User::class, 'actualizado_por');
    }
}
