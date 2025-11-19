<div>
    <div class="row justify-content-center">
        <x-adminlte-card theme="default" title="Cambiar Contraseña" class="col-md-4" icon="fas fa-unlock-alt">

            {{-- Contraseña Actual --}}
            <x-adminlte-input name="old_password" wire:model.blur="old_password"
                placeholder="EJ: Contraseña Actual..." label-class="text-lightblue" fgroup-class="col-md-12"
                igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Contraseña Actual *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Nueva Contraseña --}}
            <x-adminlte-input name="new_password" wire:model.blur="new_password" placeholder="Nueva Contraseña..."
                label-class="text-lightblue" fgroup-class="col-md-12" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Nueva Contraseña *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Confirmar Contraseña --}}
            <x-adminlte-input name="new_password_confirmation" wire:model.blur="new_password_confirmation"
                placeholder="Confirmar Contraseña..." label-class="text-lightblue" fgroup-class="col-md-12"
                igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Confirmar Contraseña *</div>
                </x-slot>
            </x-adminlte-input>

            <x-slot name="footerSlot">
                <x-adminlte-button wire:click="grabar" class="btn-sm" theme="outline-success" label="Guardar" icon="fas fa-save " />
            </x-slot>


        </x-adminlte-card>
    </div>
</div>
