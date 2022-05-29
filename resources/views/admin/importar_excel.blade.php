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

                            <form class="row g-3" action="{{url('/datos/cargaMasiva')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                 <div class="col-auto">
                                     <label for="staticEmail2 " class="">Archivo xlsx</label>

                                     <input type="file" class="form-control" id="archivo"  name="archivo" >
                                 </div>
                                 <div class="col-auto">
                                     <button type="submit" class="btn btn-outline-primary mt-3 "> <i class=" la-lg la la-upload"></i> Subir</button>
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



