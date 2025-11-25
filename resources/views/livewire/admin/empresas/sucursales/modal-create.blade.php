<div>
    {{-- FORMULARIO DE ALTA DE SUCURSAL --}}
    <x-adminlte-modal id="modal-create-sucursal-{{ $empresa->id ?? null }}"
        title="Agregar Sucursal a {{ $empresa->empresa ?? 'S/D' }}" size="xl" static-backdrop icon="fas fa-tasks"
        theme="default" wire:ignore.self class="row col-md-12">

        <div class="row col-md-12">
            {{-- Sucursal --}}
            <x-adminlte-input name="sucursal" wire:model.blur="sucursal" oninput="this.value = this.value.toUpperCase()"
                placeholder="EJ: CENTRO LOGISTICO" label-class="text-lightblue" fgroup-class="col-md-4"
                igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Sucursal *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Razon Social --}}
            <x-adminlte-input name="razon_social" wire:model.blur="razon_social"
                oninput="this.value = this.value.toUpperCase()" placeholder="EJ: GRUPO SEVIPAR S.A"
                label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Razon Social *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Ruc --}}
            <x-adminlte-input name="ruc" wire:model.blur="ruc" placeholder="EJ: 80000155-7"
                label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Ruc *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Correo --}}
            <x-adminlte-input type="email" name="correo" wire:model.blur="correo" placeholder="EJ: info@sevipar.com"
                label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Correo *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Teléfono --}}
            <x-adminlte-input name="telefono" wire:model.blur="telefono" placeholder="EJ: 0986123123"
                label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Teléfono</div>
                </x-slot>
            </x-adminlte-input>
        </div>

        {{-- Dirección --}}
        <x-adminlte-textarea name="direccion" wire:model.blur="direccion"
            oninput="this.value = this.value.toUpperCase()" placeholder="EJ: CALLE, BARRIO - CIUDAD..."
            label-class="text-lightblue" fgroup-class="col-md-12" igroup-size="sm">
            <x-slot name="prependSlot">
                <div class="input-group-text">Dirección *</div>
            </x-slot>
        </x-adminlte-textarea>


        {{-- Modal Footer --}}
        <x-slot name="footerSlot">
            <x-adminlte-button class="btn-sm" type="button" label="Guardar" theme="outline-success" icon="fas fa-save"
                wire:click="grabar" />

            <x-adminlte-button theme="outline-secondary" class="btn-sm" icon="fas fa-arrow-left" label="Cerrar"
                data-dismiss="modal" />
        </x-slot>

    </x-adminlte-modal>
</div>
