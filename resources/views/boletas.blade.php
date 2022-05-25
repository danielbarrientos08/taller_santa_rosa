@extends('layouts.app')

@section('content')

   <div class="row">
       <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Busqueda de Boleta de notas
                </div>
                <div class="card-body" style="height: 800px;">
                    <!-- <h5 class="card-title">Special title treatment</h5> -->
                    
                    <form class="row g-3" action="{{url('/boletas/buscar')}}" method="GET">
                        
                        <div class="col-auto">
                            <label for="staticEmail2 " class="mt-1">Dni Estudiante</label>
                            <!-- <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com"> -->
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" id="documento"  value="" name="documento" placeholder="Ingrese el DNI de la estudiante">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-primary mb-3"> <i class=" la-lg la la-search"></i>     Buscar</button>
                        </div>
                    </form> 
                    <hr>
                
                    @if(@$mensaje)
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong> {{$mensaje}} </strong> 
                        </div>
                    @endif


                    @if(@$nombre_archivo=='')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong> Boleta no encontrada </strong> 
                    </div>
                    @else
                    <iframe id="inlineFrameExample"
                        title="Inline Frame Example"
                        width="100%"
                        height="85%"
                        src="{{asset('boletas/'.$nombre_archivo)}}">
                    </iframe>

                    @endif
                </div>
            </div>
       </div>
   </div>

@endsection
@section('footer')


         
@endsection


