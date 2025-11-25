<div>
    {{-- Modal --}}
    <x-adminlte-modal id="modal-ver-accesos-{{ $empresa->id }}"
        title="Ver Accesos de {{ $empresa->empresa ?? 'S/D' }}" size="xl" static-backdrop icon="fas fa-tasks"
        theme="default" wire:ignore.self>

        <x-tabla titulo="Listado De Accesos">

            <x-slot name="cabeceras">
                {{-- Acceso --}}
                <th>Acceso</th>

                {{-- Sucursal --}}
                <th>Sucursal</th>

            </x-slot>

            @forelse ($accesos as $acceso)
                <tr>
                    <td>{{ $acceso->acceso ?? 'S/D' }}</td>
                    <td>{{ $acceso->sucursal->sucursal ?? 'S/D' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
                </tr>
            @endforelse

            <x-slot name="paginacion">
                {{ $accesos->links() }}
            </x-slot>
        </x-tabla>

        {{-- Este slot debe ir FUERA del form --}}
        <x-slot name="footerSlot">
            <x-adminlte-button theme="outline-secondary" class="btn-sm" icon="fas fa-arrow-left" label="Cerrar"
                data-dismiss="modal" wire:click="cerrar_modal" />
        </x-slot>

    </x-adminlte-modal>
</div>
