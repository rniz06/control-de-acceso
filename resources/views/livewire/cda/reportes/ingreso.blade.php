<div>
    <x-tabla titulo="Ingresos" excel pdf>

        <x-slot name="cabeceras">
            {{-- Fecha Hora Ingreso --}}
            <th>
                <x-adminlte-input type="date" name="" wire:model.live.debounce.200ms="buscarFechaHoraIngreso"
                    label="Fecha Ingreso" igroup-size="sm" />
            </th>

            {{-- Vehiculo --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarVehiculoPorChapa"
                    oninput="this.value = this.value.toUpperCase()" label="Vehiculo" igroup-size="sm" />
            </th>

            {{-- Ingresante --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarPersonaVisito"
                    label="Ingresante" igroup-size="sm" disabled />
            </th>

            {{-- Visita a --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarPersonaIngresa"
                    label="Visita a" igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @forelse ($personasVisitables as $persona)
                        <option value="{{ $persona->id }}">{{ $persona->nombre_completo  ?? 'S/D' }}</option>
                    @empty
                        SIN DATOS
                    @endforelse
                </x-adminlte-select>
            </th>

            {{-- Acceso --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarAccesoId"
                    label="Acceso" igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @forelse ($accesos as $acceso)
                        <option value="{{ $acceso->id }}">{{ $acceso->acceso  ?? 'S/D' }}</option>
                    @empty
                        SIN DATOS
                    @endforelse
                </x-adminlte-select>
            </th>

            {{-- Guardia --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarGuardia"
                    label="Guardia" igroup-size="sm" />
            </th>

            {{-- Empresa --}}
            {{-- <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarEmpresaId" label="Empresa"
                    igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->empresa ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </th> --}}

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>

        </x-slot>

        @forelse ($ingresos as $ingreso)
            <tr>
                <td>{{ optional($ingreso->fecha_hora_ingreso)->format('d/m/Y H:i:s') ?? 'S/D' }}</td>
                <td>{{ $ingreso->vehiculo->chapa ?? 'S/D' }}</td>
                <td>{{ $ingreso->personaIngreso->nombre_completo ?? 'S/D' }}</td>
                <td>{{ $ingreso->personaVisito->nombre_completo ?? 'S/D' }}</td>
                <td>{{ $ingreso->accesoIngreso->acceso ?? 'S/D' }}</td>
                <td>{{ $ingreso->usuarioRegistroIngreso->name ?? 'S/D' }}</td>
                <td>
                    {{-- <x-tabla-dropdown>
                        @can('Usuarios Editar')
                            <a href="{{ route('admin.usuarios.edit', $usuario->id) }}"
                                class="dropdown-item btn-sm btn-default"><i class="fas fa-edit mr-1"></i>Editar</a>
                        @endcan
                        @can('Usuarios Activar/Inactivar')
                            @if ($usuario->activo === true)
                                <x-adminlte-button label="Inactivar" icon="fas fa-ban" class="dropdown-item btn-sm"
                                    wire:click="inactivar({{ $usuario->id }})"
                                    wire:confirm="Estas Seguro que desear Inactivar este usuario?" />
                            @else
                                <x-adminlte-button label="Activar" icon="fas fa-thumbs-up" class="dropdown-item btn-sm"
                                    wire:click="activar({{ $usuario->id }})"
                                    wire:confirm="Estas Seguro que desear Activar este usuario?" />
                            @endif
                        @endcan
                        @can('Usuarios Resetear Contrasena')
                            <x-adminlte-button label="Reset. Contraseña" icon="fas fa-key" class="dropdown-item btn-sm"
                                wire:click="resetearContrasena({{ $usuario->id }})"
                                wire:confirm="Estas Seguro que desear Restablecer la contraseña por defecto de este usuario?" />
                        @endcan
                        @can('Usuarios Asignar Rol')
                            <a href="{{ route('admin.usuarios.asignar-rol', $usuario->id) }}"
                                class="dropdown-item btn-sm btn-default"><i class="fas fa-user-tag"></i> Asigar Rol</a>
                        @endcan
                    </x-tabla-dropdown> --}}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $ingresos->links() }}
        </x-slot>
    </x-tabla>
</div>
