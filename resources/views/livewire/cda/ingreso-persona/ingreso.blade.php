<div>
    <form wire:submit="grabar">
        <x-adminlte-card theme="light" title="Datos de Ingreso" icon="fas fa-info" header-class="text-muted text-sm">

            {{-- PERSONA INGRESANTE --}}
            <div class="col-md-12 row">
                {{-- Nro Cedula --}}
                <x-adminlte-input name="nro_cedula" wire:model.blur="nro_cedula" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm" oninput="this.value = this.value.toUpperCase()"
                    placeholder="EJ: 1234567">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">CI del Ingresante *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Pi Nombre Completo --}}
                <x-adminlte-input name="pi_nombre_completo" wire:model.blur="nombre_completo" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm" oninput="this.value = this.value.toUpperCase()"
                    placeholder="EJ: JUAN PEREZ" :disabled="$bloqueoFormPerIngresa">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Nombre Completo *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Personal Visitables --}}
                <x-adminlte-select name="persona_visita_id" wire:model.blur="persona_visita_id" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Visita a *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($personasVisitables as $persona)
                        <option value="{{ $persona->id }}">{{ $persona->nombre_completo ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>

                {{-- Lugar de Acceso --}}
                <x-adminlte-select name="acceso_ingreso_id" wire:model.blur="acceso_ingreso_id" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Lugar de Acceso *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($accesos as $acceso)
                        <option value="{{ $acceso->id }}">{{ $acceso->acceso ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </div>

            <x-slot name="footerSlot">
                {{-- Botón para agregar más productos --}}
                <x-adminlte-button label="Salir" theme="outline-secondary" icon="fas fa-arrow-left" class="btn-sm" />
                {{-- Guardar --}}
                <x-adminlte-button type="submit" label="Registrar Entrada" theme="outline-success" icon="fas fa-save"
                    class="btn-sm float-right" />
            </x-slot>

        </x-adminlte-card>

    </form>
</div>
