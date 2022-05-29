const toastr_options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "4000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };


function evaluateHttpResponse(status,message='')
{
    switch (status) {
        case 0:
            Swal.fire(
                'Error',
                'No se pudo conectar con el servidor, verifique su conexion a internet',
                'warning'
            )
            break;
        case 408:
            Swal.fire(
                'Error 408',
                'El proceso excedio el limite de tiempo permitido.',
                'warning'
            )
            break;
        case 401:
                Swal.fire(
                    'Su sesión ha caducado',
                    'Debe iniciar sesión nuevamente',
                    'warning'
                )
                setTimeout(function(){ location.reload();}, 4000);
                break;
        case 404:
            Swal.fire(
                'Recurso no encontrado',
                'No se encontró el recurso solicitado',
                'warning'
            )

            break;
        case 403:
            Swal.fire(
                'No Autorizado',
                'No tiene autorización para realizar esta acción.',
                'warning'
            )
            break;
        case 419:
            Swal.fire(
                'Token fallido',
                'Su llave de seguridad ha expirado.',
                'warning'
            )
            setTimeout(function(){ location.reload();}, 4000);
            break;
        case 422:
            Swal.fire(
                'Error de validación',
                'Revise el formulario para ver el detalle de los errores',
                'warning'
            )
            break;
        case 500:
            Swal.fire(
                'Error 500',
                message,
                'warning'
            )

            break;

    }
}
