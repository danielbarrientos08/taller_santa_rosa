

<table style=" border: 1px solid #0f0f0f; ">
    <thead class="thead-dark">
        <tr style="text-align: center; border: 1px solid #0f0f0f;">
            <td colspan="9" style="text-align: center; border: 1px solid #0f0f0f;"><b>LISTA DE MATRÍCULAS</b></td>
        </tr>
        <tr style="text-align: center; border: 1px solid #0f0f0f;">
            <td colspan="9" style="text-align: center; border: 1px solid #0f0f0f;"><b>TALLER:{{ $taller }} </b></td>
        </tr>
        <tr class="pc">
            <th style="font-weight: bold;  border: 1px solid #0f0f0f; width: 100%;"># </th>
            <th style="font-weight: bold;  border: 1px solid #0f0f0f; width: 100px;">DNI/CE</th>
            <th style="font-weight: bold;  border: 1px solid #0f0f0f; width: 350px;">APELLIDOS Y NOMBRES</th>
            <th style="font-weight: bold;  border: 1px solid #0f0f0f; width: 100px;">NIVEL</th>
            <th style="font-weight: bold;  border: 1px solid #0f0f0f; width: 100px;">GRADO</th>
            <th style="font-weight: bold;  border: 1px solid #0f0f0f; width: 100px;">SECCIÓN</th>
            <th style="font-weight: bold;  border: 1px solid #0f0f0f; width: 150px;">COD. TALLER</th>
            <th style="font-weight: bold;  border: 1px solid #0f0f0f; width: 220px;">NOMBRE TALLER</th>
            <th style="font-weight: bold;  border: 1px solid #0f0f0f; width: 200px;">FECHA DE REGISTRO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($matriculas as $index => $item)
        <tr>
            <td style=" border: 1px solid #0f0f0f;">{{ $index +1 }}</td>
            <td style=" border: 1px solid #0f0f0f;">{{$item->ducumento_estudiante  }}</td>
            <td style=" border: 1px solid #0f0f0f;" >{{ $item->estudiante->apellido_paterno }} {{ $item->estudiante->apellido_materno }} {{ $item->estudiante->nombres }}</td>
            <td style=" border: 1px solid #0f0f0f;">{{ $item->nivel }}</td>
            <td style=" border: 1px solid #0f0f0f;">{{ $item->grado }}</td>
            <td style=" border: 1px solid #0f0f0f;">{{ $item->seccion }}</td>
            <td style=" border: 1px solid #0f0f0f;">{{ $item->cod_taller }}</td>
            <td style=" border: 1px solid #0f0f0f;">{{ $item->taller->nombre }}</td>
            <td style=" border: 1px solid #0f0f0f;">{{ $item->fecha_registro }}</td>
        </tr>
        @endforeach
    </tbody>

</table>
