<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use \OwenIt\Auditing\Auditable;
    use HasRoles, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'usuario',
        'email',
        'nro_cedula',
        'nro_celular',
        'observacion',
        'password',
        'activo',
        'ultimo_acceso',
        'empresa_id',
        'sucursal_id',
        'departamento_id',
        'creado_por',
        'actualizado_por',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'activo'            => 'boolean',
            'ultimo_acceso'     => 'datetime',
        ];
    }

    public static function registrarAcceso($id)
    {
        static::findOrFail($id)->update(['ultimo_acceso' => now()]);
    }

    /*
    |---------------------------------------
    | RELACIONES DEL MODELO
    |---------------------------------------
    */

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    /*
    |---------------------------------------
    | FIN RELACIONES DEL MODELO
    |---------------------------------------
    */

    /**
     * Busquedor General.
     */
    #[Scope]
    protected function buscador(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('name', "%{$search}%")
                ->orWhereLike('usuario', "%{$search}%")
                ->orWhereLike('email', "%{$search}%")
                ->orWhereLike('nro_cedula', "%{$search}%")
                ->orWhereLike('nro_celular', "%{$search}%")
                ->orWhereLike('observacion', "%{$search}%");
        });
    }

    /**
     * Buscador Por Campo name.
     */
    #[Scope]
    protected function buscarName(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('name', "%{$search}%");
        });
    }

    /**
     * Buscador Por Campo usuario.
     */
    #[Scope]
    protected function buscarUsuario(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('usuario', "%{$search}%");
        });
    }

    /**
     * Buscador Por Campo email.
     */
    #[Scope]
    protected function buscarEmail(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('email', "%{$search}%");
        });
    }

    /**
     * Buscador Por Campo nro_cedula.
     */
    #[Scope]
    protected function buscarNroCedula(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('nro_cedula', "%{$search}%");
        });
    }

    /**
     * Buscador Por Campo nro_celular.
     */
    #[Scope]
    protected function buscarNroCelular(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('nro_celular', "%{$search}%");
        });
    }

    /**
     * Buscador Por Campo observacion.
     */
    #[Scope]
    protected function buscarObservacion(Builder $query, $search = null): void
    {
        $query->when($search, function (Builder $query, string $search) {
            $query->whereLike('observacion', "%{$search}%");
        });
    }

    /**
     * Buscador Por Campo activo.
     */
    #[Scope]
    protected function buscarActivo(Builder $query, $search): void
    {
        $query->when($search, function (Builder $query, $search) {
            $query->where('activo', $search);
        });
    }

    /**
     * Buscador Por Campo empresa_id.
     */
    #[Scope]
    protected function buscarEmpresaId(Builder $query, $search): void
    {
        $query->when($search, function (Builder $query, $search) {
            $query->where('empresa_id', $search);
        });
    }

    /**
     * Buscador Por Campo sucursal_id.
     */
    #[Scope]
    protected function buscarSucursalId(Builder $query, $search): void
    {
        $query->when($search, function (Builder $query, $search) {
            $query->where('sucursal_id', $search);
        });
    }

    /**
     * Buscador Por Campo departamento_id.
     */
    #[Scope]
    protected function buscarDepartamentoId(Builder $query, $search): void
    {
        $query->when($search, function (Builder $query, $search) {
            $query->where('departamento_id', $search);
        });
    }
}
