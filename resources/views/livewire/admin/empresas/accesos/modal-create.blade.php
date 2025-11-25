<div>
    {{-- FORMULARIO DE ALTA DE SUCURSAL --}}
    <x-adminlte-modal id="modal-create-acceso-{{ $empresa->id ?? null }}"
        title="Agregar Acceso a {{ $empresa->empresa ?? 'S/D' }}" size="xl" static-backdrop icon="fas fa-tasks"
        theme="default" wire:ignore.self>

        <div class="row col-md-12">
            {{-- Acceso --}}
            <x-adminlte-input name="acceso" wire:model.blur="acceso" oninput="this.value = this.value.toUpperCase()"
                placeholder="EJ: CENTRO LOGISTICO" label-class="text-lightblue" fgroup-class="col-md-6" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Acceso *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Sucursales --}}
            <x-adminlte-select name="sucursal_id" wire:model.blur="sucursal_id" label-class="text-lightblue"
                fgroup-class="col-md-6" igroup-size="sm">
                <option value="">-- Seleccionar --</option>
                @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}">{{ $sucursal->sucursal }}</option>
                @endforeach
                <x-slot name="prependSlot">
                    <div class="input-group-text">Sucursales *</div>
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
