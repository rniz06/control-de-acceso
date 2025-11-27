<?php

namespace App\Exports\Pdf\Cda\Reportes;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfListadoSalidas
{
    protected $datos;
    protected $nombre_archivo;

    public function __construct($datos, $nombre_archivo = 'Documento')
    {
        $this->datos = $datos;
        $this->nombre_archivo = $nombre_archivo;
    }

    public function download()
    {
        $pdf = Pdf::loadView('cda.reportes.pdf.pdf-salidas-listado', ['nombre_archivo' => $this->nombre_archivo, 'datos' => $this->datos]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $this->nombre_archivo . '.pdf');
    }
}
