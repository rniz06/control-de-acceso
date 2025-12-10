<div>
    {{-- TABLAS DE COLAS --}}
    <x-tabla titulo="Trabajos en Colas" paginado="paginadoColas">
        <x-slot name="cabeceras">
            {{-- Cola --}}
            <th>Cola</th>

            {{-- Payload --}}
            <th>Payload</th>
            
            {{-- Intentos --}}
            <th>Intentos</th>

            {{-- Reservado en --}}
            <th>Reservado en</th>

            {{-- Disponible en --}}
            <th>Disponible en</th>

            {{-- Cola --}}
            <th>Creado el</th>

            {{-- Acciones --}}
            <th>Acciones</th>

        </x-slot>

        @forelse ($colas as $cola)
            <tr>
                <td>{{ $cola->queue ?? 'S/D' }}</td>
                {{-- <td>{{ $cola->payload ?? 'S/D' }}</td> --}}
                <td>{{ Str::limit($cola->payload, 75, '...') }}</td>
                <td>{{ $cola->attempts ?? 'S/D' }}</td>
                <td>{{ $cola->reserved_at ?? 'S/D' }}</td>
                <td>{{ $cola->available_at ?? 'S/D' }}</td>
                <td>{{ $cola->created_at ?? 'S/D' }}</td>
                <td>{{ optional($cola->created_at)->format('d/m/Y H:i:s') ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        
                    </x-tabla-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $colas->links() }}
        </x-slot>
    </x-tabla>

    {{-- TABLA DE COLAS FALLIDAS --}}

    <x-tabla titulo="Trabajos en Cola Fallidos" paginado="paginadoFallidos">
        <x-slot name="cabeceras">
            {{-- Uuid --}}
            <th>Uuid</th>

            {{-- Connection --}}
            <th>Conexión</th>
            
            {{-- Cola --}}
            <th>Cola</th>

            {{-- Payload --}}
            <th>Payload</th>

            {{-- Exception --}}
            <th>Excepción</th>

            {{-- Failed_at --}}
            <th>Falló el</th>

            {{-- Acciones --}}
            <th>Acciones</th>

        </x-slot>

        @forelse ($fallidos as $fallido)
            <tr>
                <td>{{ $fallido->uuid ?? 'S/D' }}</td>
                {{-- <td>{{ $cola->payload ?? 'S/D' }}</td> --}}
                <td>{{ Str::limit($fallido->payload, 75, '...') }}</td>
                <td>{{ $fallido->connection ?? 'S/D' }}</td>
                <td>{{ $fallido->queue ?? 'S/D' }}</td>
                <td>{{ $fallido->payload ?? 'S/D' }}</td>
                <td>{{ $fallido->exception ?? 'S/D' }}</td>
                <td>{{ optional($cola->failed_at)->format('d/m/Y H:i:s') ?? 'S/D' }}</td>
                <td>
                    <x-tabla-dropdown>
                        
                    </x-tabla-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%" class="text-center text-muted">Sin resultados coincidentes...</td>
            </tr>
        @endforelse

        <x-slot name="paginacion">
            {{ $fallidos->links() }}
        </x-slot>
    </x-tabla>
</div>
