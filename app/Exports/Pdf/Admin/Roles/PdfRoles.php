<?php

namespace App\Exports\Pdf\Admin\Roles;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfRoles
{
    protected $datos;
    protected $encabezados;
    protected $nombre_archivo;

    public function __construct($datos, $encabezados, $nombre_archivo = 'Documento')
    {
        $this->datos = $datos;
        $this->encabezados = $encabezados;
        $this->nombre_archivo = $nombre_archivo;
    }

    public function download()
    {
        $pdf = Pdf::loadView('admin.roles.pdf.pdf-roles', ['nombre_archivo' => $this->nombre_archivo, 'datos' => $this->datos, 'encabezados' => $this->encabezados]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $this->nombre_archivo . '.pdf');
    }
}
