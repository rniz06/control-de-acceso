<div>

    {{-- FORMULARIO DE EDICION DE MODELO --}}
    <x-adminlte-modal id="modal-edit-modelo-{{$registro->id}}" title="Editar Modelo" size="lg" static-backdrop icon="fas fa-tasks"
        theme="default" wire:ignore.self>

        <div class="row col-md-12">
            {{-- Modelo --}}
            <x-adminlte-input name="modelo" wire:model.blur="modelo" oninput="this.value = this.value.toUpperCase()"
                placeholder="EJ: HILUX" label-class="text-lightblue" fgroup-class="col-md-6" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Modelo *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Marca --}}
            <x-adminlte-select name="marca_id" wire:model.blur="marca_id" label-class="text-lightblue"
                fgroup-class="col-md-6" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Marca *</div>
                </x-slot>
                <option value="">-- Seleccionar --</option>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->marca ?? 'S/D' }}</option>
                @endforeach
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
