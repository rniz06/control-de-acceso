<div>
    <form wire:submit="grabar">
        <x-adminlte-card theme="light" title="Datos de Ingreso" icon="fas fa-info" header-class="text-muted text-sm">

            <div class="col-md-12 row">
                {{-- Empresa --}}
                <x-adminlte-select name="empresa_id" wire:model.blur="empresa_id" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Empresa *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->empresa ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>

                {{-- Sucursal --}}
                <x-adminlte-select name="sucursal_id" wire:model.blur="sucursal_id" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Sucursal *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">{{ $sucursal->sucursal ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </div>
<hr>
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
                <x-adminlte-select name="marca_id" wire:model.blur="marca_id" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm" :disabled="$bloqueoFormVehiculo">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Marca *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->marca ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>

                {{-- Modelo --}}
                <x-adminlte-select name="modelo_id" wire:model.blur="modelo_id" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm" :disabled="$bloqueoFormVehiculo">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Modelo *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($modelos as $modelo)
                        <option value="{{ $modelo->id }}">{{ $modelo->modelo ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>

                {{-- Color --}}
                <x-adminlte-select name="color_id" wire:model.blur="color_id" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm" :disabled="$bloqueoFormVehiculo">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Color *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($colores as $color)
                        <option value="{{ $color->id }}">{{ $color->color ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>
            </div>

            {{-- PERSONA INGRESANTE --}}
            <div class="col-md-12 row">
                {{-- Nro Cedula --}}
                <x-adminlte-input name="pi_nro_cedula" wire:model.blur="pi_nro_cedula" label-class="text-lightblue"
                    fgroup-class="col-md-3" igroup-size="sm" oninput="this.value = this.value.toUpperCase()"
                    placeholder="EJ: 1234567">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">CI del Ingresante *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Pi Nombre Completo --}}
                <x-adminlte-input name="pi_nombre_completo" wire:model.blur="pi_nombre_completo"
                    label-class="text-lightblue" fgroup-class="col-md-3" igroup-size="sm"
                    oninput="this.value = this.value.toUpperCase()" placeholder="EJ: JUAN PEREZ" :disabled="$bloqueoFormPerIngresa">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Nombre Completo *</div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Personal Visitables --}}
                <x-adminlte-select name="persona_visita_id" wire:model.blur="persona_visita_id"
                    label-class="text-lightblue" fgroup-class="col-md-3" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Visita a *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($personasVisitables as $persona)
                        <option value="{{ $persona->id }}">{{ $persona->nombre_completo ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>

                {{-- Lugar de Acceso --}}
                <x-adminlte-select name="acceso_ingreso_id" wire:model.blur="acceso_ingreso_id"
                    label-class="text-lightblue" fgroup-class="col-md-3" igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">Lugar de Acceso *</div>
                    </x-slot>
                    <option value="">-- Seleccionar --</option>
                    @foreach ($accesos as $acceso)
                        <option value="{{ $acceso->id }}">{{ $acceso->acceso ?? 'S/D' }}</option>
                    @endforeach
                </x-adminlte-select>

                {{-- Imagen --}}
                {{-- <x-adminlte-input type="file" name="imagen" wire:model="imagen" label-class="text-lightblue"
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
                <x-adminlte-button type="submit" label="Registrar Entrada" theme="outline-success" icon="fas fa-save"
                    class="btn-sm float-right" />
            </x-slot>

        </x-adminlte-card>

    </form>
</div>
