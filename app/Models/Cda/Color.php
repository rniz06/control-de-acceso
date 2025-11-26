<?php

namespace App\Models\Cda;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Color extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $table = 'control_acceso.CDA_COLORES';

    protected $fillable = ['color', 'creado_por', 'actualizado_por'];

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'color_id');
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
     * Busqueda por campo color.
     */
    #[Scope]
    protected function buscarColor(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('color', "%{$search}%");
        });
    }

    /*
    |---------------------------------------
    | FIN SCOPES LOCALES PARA FILTROS
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
