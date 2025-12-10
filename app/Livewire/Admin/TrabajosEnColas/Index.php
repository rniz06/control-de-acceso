<?php

namespace App\Livewire\Admin\TrabajosEnColas;

use App\Models\Admin\FailedJob;
use App\Models\Admin\Job;
use Livewire\Component;

class Index extends Component
{
    public $paginadoColas = 5, $paginadoFallidos = 5;

    public function render()
    {
        return view('livewire.admin.trabajos-en-colas.index', [
            'colas' => Job::select('id', 'queue', 'payload', 'attempts', 'reserved_at', 'available_at', 'created_at')
                ->paginate($this->paginadoColas, ['*'], 'paginado-colas'),
            'fallidos' => FailedJob::select('id', 'uuid', 'connection', 'queue', 'payload', 'exception', 'failed_at')
                ->paginate($this->paginadoColas, ['*'], 'paginado-fallidos')
        ]);
    }
}
