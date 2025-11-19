<div>
    <x-tabla titulo="Usuarios" buscador excel pdf>

        @canany(['Usuarios Crear', 'Usuarios Asignar Rol'])
            <x-slot name="headerBotones">
                @can('Usuarios Crear')
                    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-sm btn-success"><i
                            class="fas fa-user-plus"></i>Añadir Usuario</a>
                @endcan
                @can('Usuarios Asignar Rol')
                    <a href="{{ route('admin.usuarios.asignar-rol-a-usuarios') }}" class="btn btn-sm btn-outline-secondary"><i
                            class="fas fa-user-tag"></i>Asig. Rol a Usuarios</a>
                @endcan
            </x-slot>
        @endcanany

        <x-slot name="cabeceras">
            {{-- Name --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarName"
                    oninput="this.value = this.value.toUpperCase()" label="Nombre" igroup-size="sm" />
            </th>

            {{-- Usuario --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarUsuario"
                    oninput="this.value = this.value.toLowerCase()" label="Usuario" igroup-size="sm" />
            </th>

            {{-- Email --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarEmail"
                    oninput="this.value = this.value.toLowerCase()" label="Email" igroup-size="sm" />
            </th>

            {{-- Activo --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarActivo" label="Activo"
                    igroup-size="sm">
                    <option value="">-- Todos --</option>
                    <option value="true">Si</option>
                    <option value="false">No</option>
                </x-adminlte-select>
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

            {{-- Departamento --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarDepartamentoId"
                    label="Departamento" igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->departamento ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </th>

            {{-- Ultimo Acceso --}}
            <th>
                <x-adminlte-input name="" label="Ultimo Acceso" igroup-size="sm" disabled />
            </th>

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>

        </x-slot>

        @forelse ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name ?? 'S/D' }}</td>
                <td>{{ $usuario->usuario ?? 'S/D' }}</td>
                <td>{{ $usuario->email ?? 'S/D' }}</td>
                <td>{{ $usuario->activo ? 'SI' : 'NO' }}</td>
                <td>{{ $usuario->empresa->empresa ?? 'S/D' }}</td>
                <td>{{ $usuario->sucursal->sucursal ?? 'S/D' }}</td>
                <td>{{ $usuario->departamento->departamento ?? 'S/D' }}</td>
                <td>{{ optional($usuario->ultimo_acceso)->format('d/m/Y H:i:s') ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        @can('Usuarios Editar')
                            <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="dropdown-item btn-sm btn-default"><i
                                    class="fas fa-edit mr-1"></i>Editar</a>
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
                            <x-adminlte-button label="Reset. Contraseña" icon="fas fa-key"
                                class="dropdown-item btn-sm" wire:click="resetearContrasena({{ $usuario->id }})"
                                wire:confirm="Estas Seguro que desear Restablecer la contraseña por defecto de este usuario?" />
                        @endcan
                        @can('Usuarios Asignar Rol')
                            <a href="{{ route('admin.usuarios.asignar-rol', $usuario->id) }}"
                                class="dropdown-item btn-sm btn-default"><i class="fas fa-user-tag"></i> Asigar Rol</a>
                        @endcan
                    </x-tabla-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $usuarios->links() }}
        </x-slot>
    </x-tabla>
</div>
