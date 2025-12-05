<?php

namespace App\Jobs\Cda\IngresoVehiculo;

use App\Mail\Cda\IngresoVehiculo\IngresoCentroLogisticoMail;
use App\Models\Cda\Vehiculo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class IngresoCentroLogisticoJob implements ShouldQueue
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
        Mail::to('dpto.informatica@rubilock.com.py')
            ->cc('ronaldalexisniznunez@gmail.com')
            //->cc('monitoreo_cctv@rubilock.com.py')
            ->queue(new IngresoCentroLogisticoMail($this->vehiculo));
    }
}
