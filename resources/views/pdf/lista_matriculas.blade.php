<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante de pago</title>
</head>
<style>
    html{
        margin-top: 60px;
        margin-left: 30px;
        margin-right: 30px;
        margin-bottom: 38px;
    }
*{
    text-decoration: none;
    margin: 0px;
    padding: 0px;
}

table{
    width: 100%
}
td, th {
    border: 1px solid #12466d;

}

td{
    font-size: 16px;
    padding: 6px;
}
*{
    margin: 0px;
    padding: 0px;
}
.pc{
    background: #12466d;
}
.sc{
    background: #BEBEBE;
}
.head{
    height: 150px;
    background: #12466d;
}
.body{
    padding: 10px;
    margin-top: 1px;
}
.logo{
    margin-top: 50px;
    width: 250px;
}
.row{
    display: block;
    margin-top: 10px;
    margin-bottom: 10px;
}
.center{
    text-align: center;
}
#table{
    border-collapse: collapse;
    border-color: blue;
}
hr{
    color: #12466d;
}
.fm{
    font-size: 18px;
}
.tl{
    color: white;
}
</style>
<body>
    
    <div class="head">
        <div class="primary-area primary-color">
            <center>
                {{--  <img src="{{ asset('img/logo2.png') }}">  --}}
            </center>
        </div>
        <br>
        
        <div class="row">
            <center>
                <h3 class="tl">LISTA DE MATRÍCULAS-TALLERES</h3>
            </center>
            <center>
                <h4 class="tl">IE. SANTA ROSA</h4>
            </center>
            <center>
                <h4 class="tl"> 0233288</h4>
            </center>
        </div>
    </div>
    <div class="body">
        {{--  <div class="row">
            <b>Taller: </b> {{ $filtros-> }}
        </div>
        <div class="row">
            <b>Nivel: </b>Varios
        </div>  --}}
       
        <div class="row">
            <table id="table">
                <thead class="thead-dark">
                    <tr class="pc">
                        <td colspan="9" class="center fm tl"><b>LISTA DE MATRÍCULAS</b></td>
                    </tr>
                    <tr class="pc">
                        <th class="center fm tl" ># </th>
                        <th class="center fm tl">DNI/CE</th>
                        <th class="center fm tl">APELLIDOS Y NOMBRES</th>
                        <th class="center fm tl">NIVEL</th>
                        <th class="center fm tl">GRADO</th>
                        <th class="center fm tl">SECCIÓN</th>
                        <th class="center fm tl">COD. TALLER</th>
                        <th class="center fm tl">NOMBRE TALLER</th>
                        <th class="center fm tl">FECHA DE REGISTRO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriculas as $index => $item)
                    <tr>
                        <td class="center">{{ $index +1 }}</td>
                        <td class="center">{{$item->ducumento_estudiante  }}</td>
                        <td class="">{{ $item->estudiante->apellido_paterno }} {{ $item->estudiante->apellido_materno }} {{ $item->estudiante->nombres }}</td>
                        <td class="center">{{ $item->nivel }}</td>
                        <td class="center">{{ $item->grado }}</td>
                        <td class="center">{{ $item->seccion }}</td>
                        <td class="center">{{ $item->cod_taller }}</td>
                        <td class="center">{{ $item->taller->nombre }}</td>
                        <td class="center">{{ $item->fecha_registro }}</td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
           
        </div>
      
    </div>
   
    <div class="footer">
        <small style="margin-left: 30px; font-size: 18px;"> Fecha de descarga: {{ date('d/m/Y H:i:s') }} </small>
    </div>
    <script type="text/php">
        if (isset($pdf)) {
            $text = "pág. {PAGE_NUM} / {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>

</html>
