<div>
    {{-- Modal --}}
    <x-adminlte-modal id="modal-ver-sucursales-{{ $empresa->id }}"
        title="Ver Sucursales de {{ $empresa->empresa ?? 'S/D' }}" size="xl" static-backdrop icon="fas fa-tasks"
        theme="default" wire:ignore.self>

        <x-tabla titulo="Listado De Sucursales">

            <x-slot name="cabeceras">
                {{-- Sucursal --}}
                <th>Sucursal</th>

                {{-- Razon Social --}}
                <th>Razon Social</th>

                {{-- Ruc --}}
                <th>Ruc</th>

                {{-- Correo --}}
                <th>Correo</th>

                <th>Teléfono</th>

                {{-- Dirección --}}
                <th>Dirección</th>

            </x-slot>

            @forelse ($sucursales as $sucursal)
                <tr>
                    <td>{{ $sucursal->sucursal ?? 'S/D' }}</td>
                    <td>{{ $sucursal->razon_social ?? 'S/D' }}</td>
                    <td>{{ $sucursal->ruc ?? 'S/D' }}</td>
                    <td>{{ $sucursal->correo ?? 'S/D' }}</td>
                    <td>{{ $sucursal->telefono ?? 'S/D' }}</td>
                    <td>{{ $sucursal->direccion ?? 'S/D' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
                </tr>
            @endforelse

            <x-slot name="paginacion">
                {{ $sucursales->links() }}
            </x-slot>
        </x-tabla>

        {{-- Este slot debe ir FUERA del form --}}
        <x-slot name="footerSlot">
            <x-adminlte-button theme="outline-secondary" class="btn-sm" icon="fas fa-arrow-left" label="Cerrar"
                data-dismiss="modal" />
        </x-slot>

    </x-adminlte-modal>
</div>
