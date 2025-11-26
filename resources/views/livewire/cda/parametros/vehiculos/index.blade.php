<div>
    <x-tabla titulo="Listado De Vehiculos Registrados">

        <x-slot name="headerBotones">
            {{-- Boton y Modal Crear --}}
            @can('Vehiculos Crear')
                <x-adminlte-button label="Añadir Vehiculo" class="btn-sm" theme="outline-success" icon="fas fa-plus"
                    data-toggle="modal" data-target="#modal-create-vehiculo" />
                @livewire('cda.parametros.vehiculos.modal-create')
            @endcan
        </x-slot>

        <x-slot name="cabeceras">
            {{-- Chapa --}}
            <th>
                <x-adminlte-input name="" wire:model.live.debounce.200ms="buscarChapa"
                    oninput="this.value = this.value.toUpperCase()" label="Chapa" igroup-size="sm" />
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

            {{-- Modelo --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarModeloId" label="Modelo"
                    igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($modelos as $modelo)
                        <option value="{{ $modelo->id }}">{{ $modelo->modelo ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </th>

            {{-- Color --}}
            <th>
                <x-adminlte-select name="" wire:model.live.debounce.200ms="buscarColorId" label="Color"
                    igroup-size="sm">
                    <option value="">-- Todos --</option>
                    @foreach ($colores as $color)
                        <option value="{{ $color->id }}">{{ $color->color ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </th>

            {{-- Acciones --}}
            <th>
                <x-adminlte-input name="" label="Acciones" igroup-size="sm" disabled />
            </th>

        </x-slot>

        @forelse ($vehiculos as $vehiculo)
            <tr>
                <td>{{ $vehiculo->chapa ?? 'S/D' }}</td>
                <td>{{ $vehiculo->marca->marca ?? 'S/D' }}</td>
                <td>{{ $vehiculo->modelo->modelo ?? 'S/D' }}</td>
                <td>{{ $vehiculo->color->color ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        @can('Vehiculos Editar')
                            {{-- Boton Abrir Modal Edicion --}}
                            <x-adminlte-button label="Editar" class="dropdown-item btn-sm" icon="fas fa-edit"
                                data-toggle="modal" data-target="#modal-edit-vehiculo-{{ $vehiculo->id }}" />
                        @endcan
                        @can('Vehiculos Eliminar')
                            <x-adminlte-button label="Eliminar" icon="fas fa-trash" class="dropdown-item btn-sm"
                                wire:click="eliminar({{ $vehiculo->id }})"
                                wire:confirm="Estas Seguro que desear ELIMINAR este vehiculo?" />
                        @endcan
                    </x-tabla-dropdown>

                    {{-- Componente con Modal Fuera del Dropdonw para evitar superposicion --}}
                    @livewire('cda.parametros.vehiculos.modal-edit', ['vehiculo_id' => $vehiculo->id], key($vehiculo->id))
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $vehiculos->links() }}
        </x-slot>
    </x-tabla>
</div>
