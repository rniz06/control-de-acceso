<div>
    <x-tabla titulo="Listado De Colores">

        <x-slot name="headerBotones">
            {{-- Boton y Modal Crear --}}
            @can('Colores Crear')
                <x-adminlte-button label="Añadir Color" class="btn-sm" theme="outline-success" icon="fas fa-plus"
                    data-toggle="modal" data-target="#modal-create-color" />
                @livewire('cda.parametros.colores.modal-create')
            @endcan
        </x-slot>

        <x-slot name="cabeceras">
            {{-- Color --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarColor"
                    oninput="this.value = this.value.toUpperCase()" label="Color" igroup-size="sm" />
            </th>

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>

        </x-slot>

        @forelse ($colores as $color)
            <tr>
                <td>{{ $color->color ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        @can('Colores Editar')
                            {{-- Boton Abrir Modal Edicion --}}
                            <x-adminlte-button label="Editar" class="dropdown-item btn-sm" icon="fas fa-edit"
                                data-toggle="modal" data-target="#modal-edit-color-{{ $color->id }}" />
                        @endcan
                        @can('Colores Eliminar')
                            <x-adminlte-button label="Eliminar" icon="fas fa-trash" class="dropdown-item btn-sm"
                                wire:click="eliminar({{ $color->id }})"
                                wire:confirm="Estas Seguro que desear ELIMINAR este Color?" />
                        @endcan
                    </x-tabla-dropdown>

                    {{-- Componente con Modal Fuera del Dropdonw para evitar superposicion --}}
                    @livewire('cda.parametros.colores.modal-edit', ['color_id' => $color->id], key($color->id))
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $colores->links() }}
        </x-slot>
    </x-tabla>
</div>
