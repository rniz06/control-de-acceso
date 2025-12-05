<?php

namespace App\Jobs;

use App\Mail\Cda\IngresoVehiculo\IngresoCentroLogistico;
use App\Models\Cda\Vehiculo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class EnviarEmailIngresoVehiculo implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Vehiculo $vehiculo)
    {
        #
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('ronaldalexisniznunez@gmail.com')->queue(new IngresoCentroLogistico($this->vehiculo));
    }
}
