<div>
    <x-tabla titulo="Salidas" excel pdf>

        <x-slot name="cabeceras">
            {{-- Fecha Hora Salida --}}
            <th>
                <x-adminlte-input type="date" name="" wire:model.live.debounce.200ms="buscarFechaHoraSalida"
                    label="Fecha Salida" igroup-size="sm" />
            </th>

            {{-- Vehiculo --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarVehiculoPorChapa"
                    oninput="this.value = this.value.toUpperCase()" label="Vehiculo" igroup-size="sm" />
            </th>

            {{-- Registro Salida --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarGuardia"
                    label="Registro Salida" igroup-size="sm" />
            </th>

            {{-- Empresa --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarEmpresaId" label="Empresa"
                    igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->empresa ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </th>

            {{-- Sucursal --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarSucursalId" label="Sucursal"
                    igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">{{ $sucursal->sucursal ?? 'S/D' }}</option>
                    @endforeach
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

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>

        </x-slot>

        @forelse ($salidas as $salida)
            <tr>
                <td>{{ optional($salida->fecha_hora_salida)->format('d/m/Y H:i:s') ?? 'S/D' }}</td>
                <td>{{ $salida->vehiculo->chapa ?? 'S/D' }}</td>
                <td>{{ $salida->usuarioRegistroSalida->name ?? 'S/D' }}</td>
                <td>{{ $salida->empresa->empresa ?? 'S/D' }}</td>
                <td>{{ $salida->sucursal->sucursal ?? 'S/D' }}</td>
                <td>{{ $salida->accesoSalida->acceso ?? 'S/D' }}</td>
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
            {{ $salidas->links() }}
        </x-slot>
    </x-tabla>
</div>
