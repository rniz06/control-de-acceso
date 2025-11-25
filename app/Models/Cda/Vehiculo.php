<?php

namespace App\Models\Cda;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Vehiculo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'control_acceso.CDA_VEHICULOS';

    protected $fillable = ['chapa', 'marca_id', 'modelo_id', 'color_id', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function ingresos()
    {
        return $this->hasMany(IngresoVehiculo::class, 'vehiculo_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */

    /*
    |---------------------------------------
    | SCOPES LOCALES PARA FILTROS
    |---------------------------------------
    */

    /**
     * Busqueda por campo chapa.
     */
    #[Scope]
    protected function buscarChapa(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('chapa', "%{$search}%");
        });
    }

    /**
     * Busqueda por relacion marca campo marca.
     */
    #[Scope]
    protected function buscarMarcaId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('marca_id', $search);
        });
    }

    /**
     * Busqueda por relacion modelo campo modelo.
     */
    #[Scope]
    protected function buscarModeloId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('modelo_id', $search);
        });
    }

    /**
     * Busqueda por relacion modelo campo modelo.
     */
    #[Scope]
    protected function buscarColorId(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->where('color_id', $search);
        });
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
