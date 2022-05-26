@extends('admin.template.app')
@push('styles')
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <h5 class="page-title mt-3">Bienvenid@</h5>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="page-title-box mt-1">

        </div>
    </div>
</div>
@endsection
@push('special_scripts')
<script src="{{asset('admin_template/js/pages/jquery.peity.min.js')}}"></script>
<script src="{{asset('admin_template/js/pages/apexcharts.min.js')}}"></script>
<script src="{{asset('admin_template/js/pages/jquery.knob.min.js')}}"></script>
@endpush
