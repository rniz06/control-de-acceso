<div class="card">
    <div class="card-header text-sm">
        <h3 class="card-title mb-2 mb-md-0 ">{{ $titulo ?? '' }}
            {{-- Botones exportación --}}
            @if ($excel)
                <button class="btn btn-sm btn-outline-success mr-1" wire:click="{{ $excel }}">
                    <i class="fas fa-file-excel"></i> Excel
                </button>
            @endif

            @if ($pdf)
                <button class="btn btn-sm btn-outline-secondary mr-1" wire:click="{{ $pdf }}">
                    <i class="fas fa-file-pdf"></i> PDF
                </button>
            @endif

            {{-- Botones adicionales --}}
            @isset($headerBotones)
                {{ $headerBotones }}
            @endisset

        </h3>

        @if ($buscador)
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <input type="text" name="buscardor" class="form-control float-right" placeholder="Buscar..."
                        wire:model.live.debounce.150ms="{{ $buscador ?? 'buscador' }}">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-sm table-bordered table-hover mb-0">
            <thead>
                <tr>
                    {{ $cabeceras }}
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if ($paginacion)
        <div class="d-flex justify-content-between align-items-center m-2">
            <div class="mb-2 mb-md-0">
                <select class="form-control form-control-sm" style="width: 55px; display:inline-block;"
                    wire:model.live="{{ $paginado }}">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
                <small>Registros por página</small>
            </div>
            <div>
                {{ $paginacion }}
            </div>
        </div>
    @endif
</div>