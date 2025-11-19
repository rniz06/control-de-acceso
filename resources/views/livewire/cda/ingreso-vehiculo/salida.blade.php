<div>
    <form wire:submit="grabar">
        <x-adminlte-card theme="light" title="Datos de Salida" icon="fas fa-info" header-class="text-muted text-sm">

            <div class="col-md-12 row">
                {{-- Vehiculo --}}
                <x-adminlte-input name="chapa" wire:model.blur="chapa" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm" oninput="this.value = this.value.toUpperCase()"
                    placeholder="EJ: ABCD123">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Chapa del Vehiculo *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Marca --}}
                <x-adminlte-input name="" label-class="text-lightblue" fgroup-class="col-md-3" igroup-size="sm"
                    value="{{ $registro->vehiculo->marca->marca ?? 'S/D' }}" readonly>
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Marca</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Modelo --}}
                <x-adminlte-input name="" label-class="text-lightblue" fgroup-class="col-md-3" igroup-size="sm"
                    value="{{ $registro->vehiculo->modelo->modelo ?? 'S/D' }}" readonly>
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Modelo</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Color --}}
                <x-adminlte-input name="" label-class="text-lightblue" fgroup-class="col-md-3" igroup-size="sm"
                    value="{{ $registro->vehiculo->color->color ?? 'S/D' }}" readonly>
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Color</div>
                    </x-slot>
                </x-adminlte-input>
            </div>

            {{-- PERSONA --}}
            <div class="col-md-12 row">

                {{-- Nombre Completo --}}
                <x-adminlte-input name="" label-class="text-lightblue" fgroup-class="col-md-3" igroup-size="sm" value="{{ $registro->personaIngreso->nombre_completo ?? 'S/D' }}"
                    readonly>
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

                {{-- Imagen --}}
                {{-- <x-adminlte-input type="file" name="imagen" wire:model.blur="imagen" label-class="text-lightblue"
                    fgroup-class="col-md-12" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Imagen *</div>
                    </x-slot>
                </x-adminlte-input>
                @if ($imagen)
                    <div class="img-thumbnail"><img src="{{ $imagen->temporaryUrl() }}" class=""></div>
                @endif --}}
            </div>

            <x-slot name="footerSlot">
                {{-- Botón para agregar más productos --}}
                <x-adminlte-button label="Salir" theme="outline-secondary" icon="fas fa-arrow-left" class="btn-sm" />
                {{-- Guardar --}}
                <x-adminlte-button type="submit" label="Registrar Salida" theme="outline-success" icon="fas fa-save"
                    class="btn-sm float-right" />
            </x-slot>

        </x-adminlte-card>

    </form>
</div>
