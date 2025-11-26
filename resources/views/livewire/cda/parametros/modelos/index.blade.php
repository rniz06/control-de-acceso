<div>
    <x-tabla titulo="Listado De Modelos">

        <x-slot name="headerBotones">
            {{-- Boton y Modal Crear --}}
            @can('Modelos Crear')
                <x-adminlte-button label="Añadir Modelo" class="btn-sm" theme="outline-success" icon="fas fa-plus"
                    data-toggle="modal" data-target="#modal-create-modelo" />
                @livewire('cda.parametros.modelos.modal-create')
            @endcan
        </x-slot>

        <x-slot name="cabeceras">
            {{-- Modelo --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarModelo"
                    oninput="this.value = this.value.toUpperCase()" label="Modelo" igroup-size="sm" />
            </th>

            {{-- Marca --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarMarcaId" label="Marca"
                    igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->marca ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </th>

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>

        </x-slot>

        @forelse ($modelos as $modelo)
            <tr>
                <td>{{ $modelo->modelo ?? 'S/D' }}</td>
                <td>{{ $modelo->marca->marca ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        @can('Modelos Editar')
                            {{-- Boton Abrir Modal Edicion --}}
                            <x-adminlte-button label="Editar" class="dropdown-item btn-sm" icon="fas fa-edit"
                                data-toggle="modal" data-target="#modal-edit-modelo-{{ $modelo->id }}" />
                        @endcan
                        @can('Modelos Eliminar')
                            <x-adminlte-button label="Eliminar" icon="fas fa-trash" class="dropdown-item btn-sm"
                                wire:click="eliminar({{ $modelo->id }})"
                                wire:confirm="Estas Seguro que desear ELIMINAR este Modelo?" />
                        @endcan
                    </x-tabla-dropdown>

                    {{-- Componente con Modal Fuera del Dropdonw para evitar superposicion --}}
                    @livewire('cda.parametros.modelos.modal-edit', ['modelo_id' => $modelo->id], key($modelo->id))
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $modelos->links() }}
        </x-slot>
    </x-tabla>
</div>
