@extends('admin.template.app')
@push('styles')
@endpush
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item active">Panel</li>
                </ol>
            </div>
            <h4 class="page-title">Carga masiva de estudidiantes</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div id="app">
    <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <div class="col-12">
                            @if ( Session::has('msg-success'))
                            <div class="alert alert-success">{{ Session::get('msg-success') }}</div>
                            @elseif(Session::has('msg-error'))
                                <div class="alert alert-danger">{{ Session::get('msg-error') }}</div>
                            @endif    
                        </div>
                            <form class="row g-3" action="{{url('/admin/cargaMasiva')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                 <div class="col-auto">
                                     <label for="staticEmail2 " class="">Archivo xlsx</label>

                                     <input type="file" class="form-control" id="archivo"  name="archivo" >
                                 </div>
                                 <div class="col-auto">
                                     
                                    <button type="submit" class="btn btn-outline-primary mt-3 "> <i class=" la-lg la la-upload"></i> Subir</button>
                                    <a href="{{ url('admin/cargaMasiva/descargarPlantilla') }}" class="btn btn-outline-success mt-3">  <i class="far fa-lg fa-file-excel"></i> Decargar plantilla</a>
                                </div>
                             </form>

                        </div> <!-- end col -->
                    </div><!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->


</div><!-- end row-->
</div>

@endsection
@push('scripts')
<script src="{{asset('admin_template/js/toggle.js')}}"></script>
@endpush



