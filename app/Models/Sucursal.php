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

class Sucursal extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'SUCURSALES';

    protected $fillable = ['sucursal', 'razon_social', 'ruc', 'correo', 'direccion', 'telefono', 'empresa_id', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function depositos()
    {
        return $this->hasMany(Deposito::class, 'empresa_id');
    }

    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'sucursal_id');
    }

    public function personas()
    {
        return $this->hasMany(Persona::class, 'sucursal_id');
    }

    public function accesos()
    {
        return $this->hasMany(Acceso::class, 'sucursal_id');
    }

    public function ingresos()
    {
        return $this->hasMany(IngresoVehiculo::class, 'sucursal_id');
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
