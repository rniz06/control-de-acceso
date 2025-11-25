<div>
    <x-tabla titulo="Listado De Empresas" excel pdf>

        <x-slot name="headerBotones">
            @can('Empresas Crear')
                <a href="{{ route('admin.empresas.create') }}" class="btn btn-sm btn-success"><i
                        class="fas fa-user-plus"></i>Añadir Empresa</a>
            @endcan
        </x-slot>

        <x-slot name="cabeceras">
            {{-- Empresa --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarEmpresa"
                    oninput="this.value = this.value.toUpperCase()" label="Empresa" igroup-size="sm" />
            </th>

            {{-- Razon Social --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarRazonSocial"
                    oninput="this.value = this.value.toLowerCase()" label="Razon Social" igroup-size="sm" />
            </th>

            {{-- Ruc --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarRuc"
                    oninput="this.value = this.value.toLowerCase()" label="Ruc" igroup-size="sm" />
            </th>

            {{-- Correo --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarCorreo"
                    oninput="this.value = this.value.toLowerCase()" label="Correo" igroup-size="sm" />
            </th>

            {{-- Teléfono --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarTelefono"
                    oninput="this.value = this.value.toLowerCase()" label="Teléfono" igroup-size="sm" />
            </th>

            {{-- Dirección --}}
            <th>
                <x-adminlte-input name="" label="Dirección" igroup-size="sm" disabled />
            </th>

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>

        </x-slot>

        @forelse ($empresas as $index => $empresa)
            <tr>
                <td>{{ $empresa->empresa ?? 'S/D' }}</td>
                <td>{{ $empresa->razon_social ?? 'S/D' }}</td>
                <td>{{ $empresa->ruc ?? 'S/D' }}</td>
                <td>{{ $empresa->correo ?? 'S/D' }}</td>
                <td>{{ $empresa->telefono ?? 'S/D' }}</td>
                <td>{{ $empresa->direccion ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        {{-- Boton Modal Ver Sucursales --}}
                        <x-adminlte-button label="Ver Sucursales" class="dropdown-item btn-sm" icon="fas fa-eye"
                            data-toggle="modal" data-target="#modal-ver-sucursales-{{ $empresa->id }}" />

                        @can('Empresas Agregar Sucursal')
                            {{-- Boton Abrir Modal --}}
                            <x-adminlte-button label="Agregar Sucursal" class="dropdown-item btn-sm" icon="fas fa-plus"
                                data-toggle="modal" data-target="#modal-create-sucursal-{{ $empresa->id }}" />
                        @endcan

                        @can('Empresas Editar')
                            <a href="{{ route('admin.empresas.edit', $empresa->id) }}"
                                class="dropdown-item btn-sm btn-default"><i class="fas fa-edit mr-1"></i>Editar</a>
                        @endcan
                        @can('Empresas Eliminar')
                            <x-adminlte-button label="Eliminar" icon="fas fa-trash" class="dropdown-item btn-sm"
                                wire:click="eliminar({{ $empresa->id }})"
                                wire:confirm="Estas Seguro que desear ELIMINAR esta empresa?" />
                        @endcan
                    </x-tabla-dropdown>

                    {{-- Componente con Modal Fuera del Dropdonw para evitar superposicion --}}
                    @livewire('admin.empresas.sucursales.modal-ver-sucursales', ['empresa_id' => $empresa->id], key($empresa->id))

                    @livewire('admin.empresas.sucursales.modal-create', ['empresa_id' => $empresa->id], key($empresa->id))
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $empresas->links() }}
        </x-slot>
    </x-tabla>
</div>
