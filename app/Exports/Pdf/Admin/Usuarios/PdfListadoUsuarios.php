<?php

namespace App\Exports\Pdf\Admin\Usuarios;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfListadoUsuarios
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
        $pdf = Pdf::loadView('admin.usuarios.pdf.pdf-usuarios-listado', ['nombre_archivo' => $this->nombre_archivo, 'datos' => $this->datos]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $this->nombre_archivo . '.pdf');
    }
}
