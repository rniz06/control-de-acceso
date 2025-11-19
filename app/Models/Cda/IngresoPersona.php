<?php

namespace App\Models\Cda;

use App\Models\Acceso;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class IngresoPersona extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'control_acceso.CDA_INGRESO_PERSONAS';

    protected $fillable = [
        'fecha_hora_ingreso',
        'persona_ingresa_id',
        'persona_visita_id',
        'acceso_ingreso_id',
        'usuario_registro_ingreso',
        'fecha_hora_salida',
        'acceso_salida_id',
        'usuario_registro_salida',
        'corresponde_salida',
        'empresa_id',
        'sucursal_id',
        'img_ruta',
        'creado_por',
        'actualizado_por'
    ];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function personaIngreso()
    {
        return $this->belongsTo(Persona::class, 'persona_ingresa_id');
    }

    public function personaVisito()
    {
        return $this->belongsTo(Persona::class, 'persona_visita_id');
    }

    public function accesoIngreso()
    {
        return $this->belongsTo(Acceso::class, 'acceso_ingreso_id');
    }

    public function usuarioRegistroIngreso()
    {
        return $this->belongsTo(User::class, 'usuario_registro_ingreso');
    }

    public function accesoSalida()
    {
        return $this->belongsTo(Acceso::class, 'acceso_salida_id');
    }

    public function usuarioRegistroSalida()
    {
        return $this->belongsTo(User::class, 'usuario_registro_salida');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */

    protected function casts(): array
    {
        return [
            'fecha_hora_ingreso'  => 'datetime',
            'fecha_hora_salida'   => 'datetime',
            'corresponde_salida'  => 'boolean'
        ];
    }

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
