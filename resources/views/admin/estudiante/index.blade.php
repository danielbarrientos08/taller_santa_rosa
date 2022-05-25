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
            <h4 class="page-title">Estudiantes</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div id="app">
    <estudiante-index></estudiante-index>
</div>

@endsection
@push('scripts')
<script src="{{asset('admin_template/js/toggle.js')}}"></script>
@endpush
