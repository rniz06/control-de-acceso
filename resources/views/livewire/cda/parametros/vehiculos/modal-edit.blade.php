<div>

    {{-- FORMULARIO DE ALTA DE SUCURSAL --}}
    <x-adminlte-modal id="modal-edit-vehiculo-{{$vehiculo->id}}" title="Editar Vehiculo" size="xl" static-backdrop icon="fas fa-tasks"
        theme="default" wire:ignore.self>

        <div class="row col-md-12">
            {{-- Chapa --}}
            <x-adminlte-input name="chapa" wire:model.blur="chapa" oninput="this.value = this.value.toUpperCase()"
                placeholder="EJ: ABCD123" label-class="text-lightblue" fgroup-class="col-md-6" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Chapa *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Nro. Móvil --}}
            <x-adminlte-input name="nro_movil" wire:model.blur="nro_movil" oninput="this.value = this.value.toUpperCase()"
                placeholder="EJ: 17" label-class="text-lightblue" fgroup-class="col-md-6" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Nro. Móvil</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Marca --}}
            <x-adminlte-select name="marca_id" wire:model.blur="marca_id" label-class="text-lightblue"
                fgroup-class="col-md-6" igroup-size="sm">
                <option value="">-- Seleccionar --</option>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->marca }}</option>
                @endforeach
                <x-slot name="prependSlot">
                    <div class="input-group-text">Marca *</div>
                </x-slot>
            </x-adminlte-select>

            {{-- Modelo --}}
            <x-adminlte-select name="modelo_id" wire:model.blur="modelo_id" label-class="text-lightblue"
                fgroup-class="col-md-6" igroup-size="sm">
                <option value="">-- Seleccionar --</option>
                @foreach ($modelos as $modelo)
                    <option value="{{ $modelo->id }}">{{ $modelo->modelo ?? 'S/D' }}</option>
                @endforeach
                <x-slot name="prependSlot">
                    <div class="input-group-text">Modelo *</div>
                </x-slot>
            </x-adminlte-select>

            {{-- Color --}}
            <x-adminlte-select name="color_id" wire:model.blur="color_id" label-class="text-lightblue"
                fgroup-class="col-md-6" igroup-size="sm">
                <option value="">-- Seleccionar --</option>
                @foreach ($colores as $color)
                    <option value="{{ $color->id }}">{{ $color->color ?? 'S/D' }}</option>
                @endforeach
                <x-slot name="prependSlot">
                    <div class="input-group-text">Color *</div>
                </x-slot>
            </x-adminlte-select>

            {{-- Empresa --}}
            <x-adminlte-select name="empresa_id" wire:model.blur="empresa_id" label-class="text-lightblue"
                fgroup-class="col-md-6" igroup-size="sm">
                <option value="">-- Seleccionar --</option>
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}">{{ $empresa->empresa ?? 'S/D' }}</option>
                @endforeach
                <x-slot name="prependSlot">
                    <div class="input-group-text">Empresa *</div>
                </x-slot>
            </x-adminlte-select>
        </div>


        {{-- Modal Footer --}}
        <x-slot name="footerSlot">
            <x-adminlte-button class="btn-sm" type="button" label="Guardar" theme="outline-success" icon="fas fa-save"
                wire:click="grabar" />

            <x-adminlte-button theme="outline-secondary" class="btn-sm" icon="fas fa-arrow-left" label="Cerrar"
                data-dismiss="modal" />
        </x-slot>

    </x-adminlte-modal>
</div>
