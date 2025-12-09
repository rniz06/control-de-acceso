<div>
    <form wire:submit="grabar">
        <x-adminlte-card theme="light" title="Datos de Salida" icon="fas fa-info" header-class="text-muted text-sm">

            {{-- PERSONA --}}
            <div class="col-md-12 row">

                {{-- Nro Cedula --}}
                <x-adminlte-input name="nro_cedula" wire:model.blur="nro_cedula" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm" oninput="this.value = this.value.toUpperCase()"
                    placeholder="EJ: 1234567">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">CI del Saliente *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Nombre Completo --}}
                <x-adminlte-input name="" label-class="text-lightblue" fgroup-class="col-md-3" igroup-size="sm"
                    value="{{ $registro->personaIngreso->nombre_completo ?? 'S/D' }}" readonly>
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Nombre Completo *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Lugar de Acceso --}}
                <x-adminlte-select name="acceso_salida_id" wire:model.blur="acceso_salida_id"
                    label-class="text-lightblue" fgroup-class="col-md-3" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Lugar de Salida *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($accesos as $acceso)
                        <option value="{{ $acceso->id }}">{{ $acceso->acceso ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </div>

            <x-slot name="footerSlot">
                {{-- Botón de retroceso --}}
                <a href="{{ route('cda.panel-central.index') }}"
                    class="btn btn-outline-secondary text-decoration-none btn-sm"><i
                        class="fas fa-arrow-left mr-1"></i>Volver</a>
                {{-- Guardar --}}
                <x-adminlte-button type="submit" label="Registrar Entrada" theme="outline-success" icon="fas fa-save"
                    class="btn-sm float-right" />
            </x-slot>

        </x-adminlte-card>

    </form>
</div>
