<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante de pago</title>
</head>
<style>
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
    padding: 50px;
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
    font-size: 20px;
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
                <h3 class="tl">CONSTANCIA DE MATRÍCULA-TALLERES</h3>
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
        {{--  <hr>  --}}
        <br>
        <div class="row">
            <b>Estudiante: </b>{{$estudiante->nombres}} {{$estudiante->apellido_paterno}} {{$estudiante->apellido_materno}}
        </div>
        <div class="row">
            <b>N° de documento: </b>{{$estudiante->documento}}
        </div>
        <div class="row">
            <b>Nivel: </b>{{$estudiante->nivel}}
        </div>
        <div class="row">
            <b>Grado: </b>{{$estudiante->grado}}
        </div>
        <div class="row">
            <b>Sección: </b>{{$estudiante->seccion}}
        </div>
        <div class="row">
            <table id="table">
                <thead>
                    <tr class="pc">
                        <td colspan="3" class="center fm tl"><b>DATOS DE MATRÍCULAS</b></td>
                    </tr>
                    <tr>
                        <td class="center fm "><b>CÓDIGO TALLER</b></td>
                        <td class="center fm"><b>TALLER</b></td>
                        <td class="center fm"><b>FECHA DE REGISTRO</b></td>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriculas as $matricula)
                    <tr>
                        <td class="center fm">{{$matricula->taller->cod_taller}}</td>
                        <td class="center fm">{{$matricula->taller->nombre}}</td>
                        <td class="center fm"> {{$matricula->fecha_registro}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">

    </div>
</body>
</html>
