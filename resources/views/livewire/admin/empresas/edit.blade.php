<div>
    {{-- Formulario --}}
    <x-adminlte-card theme="light" title="Añadir Empresa" icon="fas fa-plus-circle" header-class="text-muted text-sm">
        <form class="row col-md-12 p-2" wire:submit="guardar">

            {{-- Empresa --}}
            <x-adminlte-input name="empresa" wire:model.blur="empresa" oninput="this.value = this.value.toUpperCase()"
                placeholder="EJ: GRUPO SEVIPAR" label-class="text-lightblue" fgroup-class="col-md-4" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Empresa *</div>
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

            {{-- Dirección --}}
            <x-adminlte-textarea name="direccion" wire:model.blur="direccion"
                oninput="this.value = this.value.toUpperCase()" placeholder="EJ: CALLE, BARRIO - CIUDAD..."
                label-class="text-lightblue" fgroup-class="col-md-12" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Dirección *</div>
                </x-slot>
            </x-adminlte-textarea>

            {{-- Botón de Volver --}}
            <div class="form-group col-md-3 d-flex align-items-end">
                <a href="{{ route('admin.empresas.index') }}"
                    class="btn btn-block btn-outline-secondary text-decoration-none btn-sm"><i
                        class="fas fa-arrow-left mr-1"></i>Volver</a>
            </div>
            {{-- Botón de Guardar --}}
            <div class="form-group col-md-3 d-flex align-items-end">
                <x-adminlte-button type="submit" label="Guardar" theme="outline-success" icon="fas fa-lg fa-save"
                    class="w-100 btn-sm" />
            </div>
        </form>
    </x-adminlte-card>
</div>
