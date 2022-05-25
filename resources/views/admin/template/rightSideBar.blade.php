<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="mdi mdi-close"></i>
        </a>
        <h5 class="m-0 text-white">Settings</h5>
    </div>
    <div class="slimscroll-menu">
        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img src="{{ asset('img/admin/users/default.jpg') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
            </div>


            {{--  <h5><a href="javascript: void(0);">{{ Auth::guard('admin')->user()->nombres }}</a> </h5>  --}}
            {{--  <p class="text-muted mb-0"><small>{{ Auth::guard('admin')->user()->rol->nombre }}</small></p>  --}}

        </div>

        <!-- Settings -->
       

    </div> <!-- end slimscroll-menu-->
</div>
