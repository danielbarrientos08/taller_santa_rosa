<template>

      <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="col-12">
                                <div class="row">
                                    <h5 class="card-title mt-2 mr-2">Registro de matrículas</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="float-right" >

                                    <button type="button" class="btn btn-xs btn-flat btn-success btn-width" @click.prevent="crearMatricula()">
                                        <i class="fe-plus-circle"></i> Agregar matrícula
                                    </button>

                                <button type="button" class="btn btn-xs btn-flat btn-light btn-width waves-effect waves-light"  @click.prevent="pageReload()" > <i class="fe-refresh-ccw"></i> Recargar</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive">
                                <fieldset>
                                    <legend> Registros </legend>
                                    <template v-if="listaMatriculas.length">
                                        <table class="table table-condensed table-sm table-hover mb-0">
                                            <thead class="thead-dark">
                                                <th class="text-light">DNI/CE</th>
                                                <th class="text-light">Apellidos y Nombres</th>
                                                <th class="text-light">Nivel</th>
                                                <th class="text-light">Grado</th>
                                                <th class="text-light">Sección</th>
                                                <th class="text-light">Taller</th>
                                                <th class="text-light">Día</th>
                                              
                                                <th class="text-light">Eliminar</th>

                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in listaMatriculas" :key="index">
                                                    <td v-text="item.estudiante.documento "></td>
                                                    <td v-text="item.estudiante.apellido_paterno +' '+ item.estudiante.apellido_materno +' '+item.estudiante.nombres "></td>
                                                    <td v-text="item.estudiante.nivel"></td>
                                                    <td v-text="item.estudiante.grado"></td>
                                                    <td v-text="item.estudiante.seccion"></td>
                                                    <td v-text="item.taller.nombre"></td>
                                                    <td v-text="item.dia_semana"></td>
                                                   
                                                    <td>
                                                        <button class="btn btn-outline-danger btn-xs waves-effect waves-light" @click.prevent="eliminarMatricula(item.matricula_id,item.taller.nombre)" title="Eliminar">
                                                            <i class="fe-trash-2"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </template>
                                    <template v-else>
                                        <div class="alert alert-info">
                                            <h5>No se encontraron resultados ....</h5>
                                        </div>
                                    </template>
                                </fieldset>
                            </div><!-- end table-responsive -->

                        </div> <!-- end col -->
                    </div><!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->

    <div class="modal fade" id="matriculaCreateModal" tabindex="-1" aria-labelledby="matriculaCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" v-loading="loading"  element-loading-text="Procesando..." >
                <div class="modal-header">
                    <h5 class="modal-title" v-text="tituloModal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="registrarMatricula()" >
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label  class="col-form-label">Taller</label>
                                    <el-select v-model="datosMatricula.taller_id" @change="validarTallerSeleccionado()" placeholder="Seleccione"  style="width:100%;" required>
                                        <el-option
                                            v-for="item in listaTalleres"
                                            :key="item.taller_id"
                                            :label="item.nombre"
                                            :value="item.taller_id"
                                        >
                                        </el-option>
                                    </el-select>
                                <small v-if="mensajeValidacion.taller_id != '' " v-text="mensajeValidacion.taller_id" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label  class="col-form-label">Día semana</label>
                                <el-select v-model="datosMatricula.dia_semana" @change="validarDiaSeleccionado()" placeholder="Seleccione" style="width:100%;" required>
                                    <el-option
                                        v-for="item in listaDias"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                    >
                                    </el-option>
                                </el-select>
                                <small v-if="mensajeValidacion.dia_semana != '' " v-text="mensajeValidacion.dia_semana" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="la la-close"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="la la-check"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- end row-->

</template>

<script>
// import EstudianteCrear from './Crear'

export default
{
    // components:{EstudianteCrear},

    data()
    {
        return {
            baseUrl: base_url,
            estudiante: {},
            listaTalleres: [
            ],
            listaMatriculas: [
            ],
             mensajeValidacion: {
                taller_id: '',
                dia_semana: '',
            },
            periodo:{},
            listaDias: [
                {value: 'LUNES',label:'LUNES'},
                {value: 'MARTES',label:'MARTES'},
                {value: 'MIERCOLES',label:'MIERCOLES'},
                {value: 'JUEVES',label:'JUEVES'},
            ],
            pagination:{
                currentPage: 0,
                lastPage:0,
                perPage:0,
                from:0,
                to:0,
                total:0,
            },
            datosMatricula: {
                taller_id: '',
                dia_semana: ''
            },
            loading: false,
            edicionIndex: null,
            tituloModal:''
        }
    },

    mounted(){
        this.$nextTick(function () {
            //Código que se ejecutará solo después de haber renderizado la vista completa
            this.listarMatriculas();
        })

        // EventBus.$on('actualizarMatricula', data =>{
        //     // this.actualizarMatricula(data)
        // })
    },
    methods:{
        selectPage(page)
        {
            // this.pagination.currentPage = page;
            // this.listarMatriculas(page)
        },
       registrarMatricula() {
            this.loading = true
            let url = base_url +'/matriculas/crear'

            axios.post(url,this.datosMatricula)
            .then(response =>{

                this.resetearFormulario();

                Swal.fire({
                    title: 'Matrícula registrada correctamente',
                    text: '¿Desea registrar otra matrícula ?, recuerde que solo puede registar 2 como máximo',
                    icon: 'success',
                    showCancelButton: true,
                    cancelButtonText: `No`,
                    showConfirmButton: true,
                    confirmButtonText: `Si`,
                    confirmButtonColor: "#23b397",
                    cancelButtonColor: "#98a6ad",
                }).then((result) => {

                    if (result.isConfirmed)
                        Swal.close();
                    else{
                        $('#matriculaCreateModal').modal('toggle');
                        this.listarMatriculas();
                    }
                })
            })
            .catch(error =>{
                evaluateHttpResponse(error.response.status)

                if(error.response.status == 422){
                    let errors = error.response.data.errors
                    this.setMensajeValidacion(errors);
                }
            })
            .finally(() => this.loading = false);
       },
        editarMatricula(id,index)
        {
            this.edicionIndex = index
            $('#matriculaCreateModal').modal('toggle');
        },
        eliminarMatricula(id,name)
        {
            Swal.fire({
                title: 'Eliminar mátricula',
                html: "¿Estás seguro(a) de eliminar tu matrícula del taller: <b>"+ name+"</b>?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#f0643b",
                cancelButtonColor: "#98a6ad",
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.loading = true

                    let url = base_url +'/matriculas/eliminar/'+id

                    axios.delete(url)
                    .then(response =>{
                        Swal.fire('Matrícula  eliminada correctamente.','','success')
                        this.listarMatriculas();

                    })
                    .catch(error =>{
                        evaluateHttpResponse(error.response.status)

                        if(error.response.status == 409){
                            Swal.fire('No se pudo eliminar la matrícula.','Existen varios registros relacionados a este registro.','','error');
                        }
                    })
                    .finally(() => this.loading = false);
                }
            })
        },
        async validarTallerSeleccionado(){
            const matriculaRepetida = await this.listaMatriculas.filter((item) => item.taller_id === this.datosMatricula.taller_id );
            const taller = await this.listaTalleres.filter((item)=> item.taller_id === this.datosMatricula.taller_id );

            if(matriculaRepetida.length >0){
              Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Ya estás llevando el taller: ${taller[0].nombre},elige otro taller.`,
                    });

                this.datosMatricula.taller_id = null;
            }

        },
        async validarDiaSeleccionado(){
            const matriculaRepetida = await this.listaMatriculas.filter((item) => item.dia_semana === this.datosMatricula.dia_semana );
            console.log('matricularepetida:', matriculaRepetida);
              if(matriculaRepetida.length > 0){
                   Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Ya estás llevando el taller: ${matriculaRepetida[0].taller.nombre} el día ${this.datosMatricula.dia_semana}, elige otro día.`,
                    });
                this.datosMatricula.dia_semana = null;
            }
        },
        actualizarMatricula(data)
        {
            this.listaMatriculas.splice(this.edicionIndex, 1, data);
        },
        listarMatriculas()
        {
            this.loading = true

            let url = base_url +'/matriculas/listar'

            axios.get(url)
            .then(response =>{
                let data = response.data
                this.setData(data);
            })
            .catch(error =>{
                evaluateHttpResponse(error.response.status)
            })
            .finally(() => this.loading = false);
        },
        setData(data)
        {
            this.listaMatriculas = data.matriculas
            this.listaTalleres = data.talleres
            this.estudiante = data.estudiante
            this.periodo = data.periodo

            // this.pagination.to          = data.to
            // this.pagination.from        = data.from
            // this.pagination.total       = data.total
            // this.pagination.perPage     = data.per_page
            // this.pagination.lastPage    = data.last_page
            // this.pagination.currentPage = data.current_page
        },
        resetearFormulario()
        {
            //limpiar mensajes
            for( const index in this.mensajeValidacion){
                this.mensajeValidacion[index] = ''
            }

            this.datosMatricula.taller_id   = ''
            this.datosMatricula.dia_semana  = ''

        },
        pageReload()
        {
            location.reload()
        },
         crearMatricula()
        {   
            if(this.listaMatriculas.length >1){
                Swal.fire({
                    icon: 'info',
                    title: 'Notificación',
                    text: `No puedes llevar más de dos (2) talleres.`,
                    });
            }
            else{
                this.tituloModal ='Agregar matrícula'
                $('#matriculaCreateModal').modal('toggle');
            }
        },
        resetSearchForm(){
            this.datosFormularioBusqueda.nombres = ''
            this.datosFormularioBusqueda.estado = ''
        },
        setMensajeValidacion(errors)
        {
            //limpiar mensajes
            for( const index in this.mensajeValidacion){
                this.mensajeValidacion[index] = ''
            }
            //asignar nuevos mensajes
            for (const index in errors) {
                this.mensajeValidacion[index] = errors[index][0]
            }
        },
    },
    computed:{
        linksList(){
            let totalPages = this.pagination.lastPage
            let count= 1;
            let linksArray = []
                while(count <= totalPages)
                {
                    linksArray.push({
                        'value':count,
                        'label': 'pág. '+ count +' de '+totalPages
                    })

                    count++
                }

            return linksArray
        }
    },
}
</script>

<style>

.el-input__inner {
    -webkit-appearance: none;
    background-color: #FFF;
    background-image: none;
    border-radius: 4px;
    border: 1px solid #DCDFE6;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    color: #606266;
    display: inline-block;
    font-size: inherit;
    height: 35px;
    line-height: 35px;
    outline: 0;
    padding: 0 15px;
    -webkit-transition: border-color .2s cubic-bezier(.645,.045,.355,1);
    transition: border-color .2s cubic-bezier(.645,.045,.355,1);
    width: 100%;
}
</style>
