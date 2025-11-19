<div>
    {{-- Formulario --}}
    <x-adminlte-card theme="light" title="Añadir Rol" icon="fas fa-plus-circle" header-class="text-muted text-sm">
        <form class="row col-md-12 p-2" wire:submit="guardar">

            {{-- Nombre --}}
            <x-adminlte-input name="name" wire:model.blur="name" oninput="this.value = this.value.toUpperCase()"
                placeholder="EJ: ADMIN" label-class="text-lightblue" fgroup-class="col-md-12" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text">Nombre *</div>
                </x-slot>
            </x-adminlte-input>

            {{-- Permisos --}}
            <x-adminlte-select name="permisos" wire:model.blur="permisos" multiple label-class="text-lightblue" wire:ignore
                fgroup-class="col-md-12" size="5">
                @forelse ($permisosParaSelect as $permiso)
                    <option value="{{ $permiso->name ?? 'S/D' }}">{{ $permiso->name ?? 'S/D' }}</option>
                @empty
                    <option disabled>Sin Permisos Registrados</option>
                @endforelse
                <x-slot name="prependSlot">
                    <div class="input-group-text">Permisos *</div>
                </x-slot>
            </x-adminlte-select>

            {{-- Botón de Volver --}}
            <div class="form-group col-md-3 d-flex align-items-end">
                <a href="{{ route('admin.roles.index') }}"
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
