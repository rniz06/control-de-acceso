<div>
    {{-- Formulario --}}
    <x-adminlte-card theme="light" title="Añadir Rol" icon="fas fa-plus-circle" header-class="text-muted text-sm">
        <form class="row col-md-12 p-2" wire:submit="guardar">

            {{-- Rol --}}
            <x-adminlte-select name="rol" wire:model.live="rol" label-class="text-lightblue" fgroup-class="col-md-12"
                igroup-size="sm" wire:ignore>
                <x-slot name="prependSlot">
                    <div class="input-group-text">Roles *</div>
                </x-slot>
                <option value="">-- Seleccionar --</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->name ?? 'S/D' }}">{{ $rol->name ?? 'S/D' }}</option>
                @endforeach
            </x-adminlte-select>

            {{-- Permisos --}}
            <x-adminlte-select name="usuarios" wire:model.blur="usuarios" multiple label-class="text-lightblue"
                wire:ignore fgroup-class="col-md-12" size="5">
                @forelse ($usuariosParaSelect as $usuario)
                    <option value="{{ $usuario->id ?? 'S/D' }}">{{ $usuario->name ?? 'S/D' }}</option>
                @empty
                    <option disabled>Sin Usuarios Registrados</option>
                @endforelse
                <x-slot name="prependSlot">
                    <div class="input-group-text">Usuarios *</div>
                </x-slot>
            </x-adminlte-select>

            {{-- Botón de Volver --}}
            <div class="form-group col-md-3 d-flex align-items-end">
                <a href="{{ route('admin.usuarios.index') }}"
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
    <h6 class="font-italic font-weight-bold">Obs: Esta vista solo asigna roles, no los quita.</h6>
</div>
