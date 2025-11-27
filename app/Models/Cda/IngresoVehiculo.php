<?php

namespace App\Models\Cda;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Acceso;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class IngresoVehiculo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'control_acceso.CDA_INGRESO_VEHICULOS';

    protected $fillable = [
        'fecha_hora_ingreso',
        'vehiculo_id',
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
        'img_entrada',
        'img_salida',
        'creado_por',
        'actualizado_por'
    ];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

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
    | SCOPES LOCALES PARA FULTROS
    |---------------------------------------
    */

    /**
     * Busqueda por campo fecha_hora_ingreso.
     */
    #[Scope]
    protected function buscarFechaHoraIngreso(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereDate('fecha_hora_ingreso', '>=', $search);
        });
    }

    /**
     * Busqueda por relacion vehiculo campo chapa.
     */
    #[Scope]
    protected function buscarVehiculoPorChapa(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereRelation('vehiculo', 'chapa', 'like', "%{$search}%");
        });
    }

    /**
     * Busqueda por campo persona_visita_id.
     */
    #[Scope]
    protected function buscarPersonaVisitoId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('persona_visita_id', $search);
        });
    }

    /**
     * Busqueda por campo empresa_id.
     */
    #[Scope]
    protected function buscarEmpresaId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('empresa_id', $search);
        });
    }

    /**
     * Busqueda por campo sucursal_id.
     */
    #[Scope]
    protected function buscarSucursalId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('sucursal_id', $search);
        });
    }

    /**
     * Busqueda por relacion personaVisita campo acceso_ingreso_id.
     */
    #[Scope]
    protected function buscarAccesoId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('acceso_ingreso_id', $search);
        });
    }

    /*
    |---------------------------------------
    | FIN SCOPES LOCALES PARA FULTROS
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
