@extends('layouts.app')

@section('content')

   <div class="row">
       <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   CARGA MASIVA DE ESTUDIANTES
                </div>
                <div class="card-body">
                    <!-- <h5 class="card-title">Special title treatment</h5> -->
                    <form class="row g-3" action="{{url('/datos/cargaMasiva')}}" method="POST" enctype="multipart/form-data">
                       @csrf
                        <div class="col-auto">
                            <label for="staticEmail2 " class="mt-1">Archivo xlsx</label>
                            <!-- <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com"> -->
                        </div>
                        <div class="col-auto">
                            <label for="inputPassword2" class="visually-hidden">boleta</label>
                            <input type="file" class="form-control" id="archivo"  value="" name="archivo" placeholder="Ingrese DNI o Código del estudiante">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-primary mb-3"> <i class=" la-lg la la-upload"></i> Subir</button>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
       </div>
   </div>

@endsection
@section('footer')


         
@endsection


