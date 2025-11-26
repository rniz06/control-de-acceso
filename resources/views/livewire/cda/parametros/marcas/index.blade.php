<div>
    <x-tabla titulo="Listado De Marcas">

        <x-slot name="headerBotones">
            {{-- Boton y Modal Crear --}}
            @can('Vehiculos Crear')
                <x-adminlte-button label="Añadir Marca" class="btn-sm" theme="outline-success" icon="fas fa-plus"
                    data-toggle="modal" data-target="#modal-create-marca" />
                @livewire('cda.parametros.marcas.modal-create')
            @endcan
        </x-slot>

        <x-slot name="cabeceras">
            {{-- Marca --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarMarca"
                    oninput="this.value = this.value.toUpperCase()" label="Marca" igroup-size="sm" />
            </th>

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>

        </x-slot>

        @forelse ($marcas as $marca)
            <tr>
                <td>{{ $marca->marca ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        @can('Vehiculos Editar')
                            {{-- Boton Abrir Modal Edicion --}}
                            <x-adminlte-button label="Editar" class="dropdown-item btn-sm" icon="fas fa-edit"
                                data-toggle="modal" data-target="#modal-edit-marca-{{ $marca->id }}" />
                        @endcan
                        @can('Vehiculos Eliminar')
                            <x-adminlte-button label="Eliminar" icon="fas fa-trash" class="dropdown-item btn-sm"
                                wire:click="eliminar({{ $marca->id }})"
                                wire:confirm="Estas Seguro que desear ELIMINAR esta marca?" />
                        @endcan
                    </x-tabla-dropdown>

                    {{-- Componente con Modal Fuera del Dropdonw para evitar superposicion --}}
                    @livewire('cda.parametros.marcas.modal-edit', ['marca_id' => $marca->id], key($marca->id))
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $marcas->links() }}
        </x-slot>
    </x-tabla>
</div>
