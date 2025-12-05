<x-mail::message>
# {{ $saludo ?? '' }}

Por medio de la presente, informamos el ingreso del Móvil N°{{ $vehiculo->nro_movil ?? '' }} Chapa: {{ $vehiculo->chapa ?? 'S/D' }} al predio del Centro Logístico.

![Imagen.](https://rubilock.com.py/wp-content/uploads/2022/06/logo-rubilock-grupo-sevipar-web2022.png)

Dejamos Constancia para lo que hubiere lugar y quedamos a disposición para cualquier información adicional.<br>
{{ config('app.name') }}
</x-mail::message>
