<template>
    <div class="modal fade" id="estudianteCreateModal" tabindex="-1" aria-labelledby="estudianteCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" v-loading="loading"  element-loading-text="Procesando..." >
                <div class="modal-header">
                    <h5 class="modal-title" v-text="tituloModal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="submitForm()" >
                    <div class="modal-body">


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  class="col-form-label">DNI/CE</label>
                                <input  type="text" class="form-control" placeholder="Ingrese nombres " v-model="datosFormulario.documento" required maxlength="14">
                                <small v-if="mensajeValidacion.documento != '' " v-text="mensajeValidacion.documento" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity" class="col-form-label">Código</label>
                                <input type="text" placeholder="Ingrese apellido" class="form-control" v-model="datosFormulario.codigo_estudiante" required maxlength="14" minlength="14">
                                <small v-if="mensajeValidacion.codigo_estudiante != '' " v-text="mensajeValidacion.codigo_estudiante" class="text-danger"></small>
                            </div>
                           
                        </div>
                      
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  class="col-form-label">Nombre</label>
                                <input  type="text" class="form-control" placeholder="Ingrese nombres " v-model="datosFormulario.nombres" required maxlength="40">
                                <small v-if="mensajeValidacion.nombres != '' " v-text="mensajeValidacion.nombres" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity" class="col-form-label">Apellido Paterno</label>
                                <input type="text" placeholder="Ingrese apellido" class="form-control" v-model="datosFormulario.apellido_paterno" required maxlength="40">
                                <small v-if="mensajeValidacion.apellido_paterno != '' " v-text="mensajeValidacion.apellido_paterno" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity" class="col-form-label">Apellido Materno</label>
                                <input type="text" placeholder="Ingrese apellido" class="form-control" v-model="datosFormulario.apellido_materno" required maxlength="40">
                                <small v-if="mensajeValidacion.apellido_materno != '' " v-text="mensajeValidacion.apellido_materno" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label  class="col-form-label">Sexo</label>
                                    <el-select v-model="datosFormulario.sexo" placeholder="Seleccione"  style="width:100%;" required>
                                        <el-option
                                            v-for="item in listaSexo"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value"
                                        >
                                        </el-option>
                                    </el-select>
                                    <small v-if="mensajeValidacion.estado != '' " v-text="mensajeValidacion.estado" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label  class="col-form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" v-model="datosFormulario.fecha_nacimiento" required>
                                <small v-if="mensajeValidacion.fecha_nacimiento != '' " v-text="mensajeValidacion.fecha_nacimiento" class="text-danger"></small>
                            </div>
                            
                        </div>
                        

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                    <label  class="col-form-label">Grado</label>
                                    <el-select v-model="datosFormulario.grado" placeholder="Seleccione"  style="width:100%;" required>
                                        <el-option
                                            v-for="item in listaGrados"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value"
                                        >
                                        </el-option>
                                    </el-select>
                                    <small v-if="mensajeValidacion.estado != '' " v-text="mensajeValidacion.estado" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label  class="col-form-label">Seccion</label>
                                <el-select v-model="datosFormulario.seccion" placeholder="Seleccione" style="width:100%;" required>
                                    <el-option
                                        v-for="item in listaSecciones"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                    >
                                    </el-option>
                                </el-select>
                                <small v-if="mensajeValidacion.seccion != '' " v-text="mensajeValidacion.seccion" class="text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label  class="col-form-label">Estado de Matrícula</label>
                                <el-select v-model="datosFormulario.estado_matricula" placeholder="Seleccione"  style="width:100%;" required>
                                    <el-option
                                        v-for="item in listaEstadoMatricula"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                    >
                                    </el-option>
                                </el-select>
                                <small v-if="mensajeValidacion.estado_matricula != '' " v-text="mensajeValidacion.estado_matricula" class="text-danger"></small>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="resetearFormulario()" class="btn btn-light"> Limpiar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="la la-close"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="la la-check"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return {

            datosFormulario:{
                estudiante_id: '',
                documento: '',
                codigo_estudiante: '',
                nombres: '',
                apellido_paterno: '',
                apellido_materno: '',
                fecha_nacimiento: '',
                estado_matricula: '',
                tipo_vacante: '',
                sexo: '',
                grado: '',
                seccion: '',
            },
            mensajeValidacion: {
                estudiante_id: '',
                documento: '',
                codigo_estudiante: '',
                nombres: '',
                apellido_paterno: '',
                apellido_materno: '',
                fecha_nacimiento: '',
                estado_matricula: '',
                tipo_vacante: '',
                sexo: '',
                grado: '',
                seccion: '',
            },
            listaGrados: [
                {value: 'PRIMERO' ,label:'PRIMERO'},
                {value: 'SEGUNDO' ,label:'SEGUNDO'},
                {value: 'TERCERO' ,label:'TERCERO'},
                {value: 'CUARTO' ,label:'CUARTO'},
                {value: 'QUINTO' ,label:'QUINTO'},
            ],
            listaSexo: [
                {value: 'Mujer' ,label:'Mujer'},               
            ],
            listaSecciones: [
                {value: 'A' ,label:'A'},
                {value: 'B' ,label:'B'},
                {value: 'C' ,label:'C'},
                {value: 'D' ,label:'D'},
                {value: 'E' ,label:'E'},
            ],
            listaEstadoMatricula: [
                {value: 'TEMPORAL' ,label:'TEMPORAL'},
                {value: 'DEFINITIVA' ,label:'DEFINITIVA'},
                
            ],
            loading: false,
            tituloModal:''
        }
    },
    mounted(){
        this.$nextTick(function () {
        })

        EventBus.$on('crearEstudiante', data =>{
            console.log('recivido');
            this.tituloModal = 'Nuevo estudiante'
            $('#estudianteCreateModal').modal('toggle');
            this.resetearFormulario()
        })

        EventBus.$on('editarEstudiante', data =>{
            this.editarEstudiante(data)
            this.resetearFormulario()
        })
    },
    methods: {

        editarEstudiante(id)
        {
            let url = base_url +'/admin/estudiantes/obtener/'+id

            axios.get(url)
            .then(response =>{
                let data = response.data.response
                //asignar valores
                    this.datosFormulario.estudiante_id     = data.estudiante_id
                    this.datosFormulario.nombres           = data.nombres
                    this.datosFormulario.documento         = data.documento
                    this.datosFormulario.codigo_estudiante = data.codigo_estudiante
                    this.datosFormulario.apellido_paterno  = data.apellido_paterno
                    this.datosFormulario.apellido_materno  = data.apellido_materno
                    this.datosFormulario.fecha_nacimiento  = data.fecha_nacimiento
                    this.datosFormulario.estado_matricula  = data.estado_matricula
                    this.datosFormulario.tipo_vacante      = data.tipo_vacante
                    this.datosFormulario.sexo              = data.sexo
                    this.datosFormulario.grado             = data.grado
                    this.datosFormulario.seccion           = data.seccion

                this.tituloModal = 'Editar estudiante'
                $('#estudianteCreateModal').modal('toggle');
            })
            .catch(error =>{
                evaluateHttpResponse(error.response.status)
            })
        },

        submitForm()
        {
            if(this.datosFormulario.estudiante_id != '')
                this.actualizarEstudiante()
            else
                this.crearEstudiante()
        },
        crearEstudiante()
        {
            this.loading = true
            let url = base_url +'/admin/estudiantes/crear'

            axios.post(url,this.datosFormulario)
            .then(response =>{

                this.resetearFormulario();

                Swal.fire({
                    title: 'Estudiante registrado correctamente',
                    text: '¿Desea registrar un nuevo estudiante ?',
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
                    else
                        $('#estudianteCreateModal').modal('toggle');
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
        actualizarEstudiante()
        {
            this.loading = true

            let url = base_url +'/admin/estudiantes/actualizar'

            axios.put(url,this.datosFormulario)
            .then(response =>{
                let data = response.data.response

                $('#estudianteCreateModal').modal('toggle');

                Swal.fire('!Cambios realizados correctamente!','','success')
                EventBus.$emit('actualizarEstudiante', data)
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
        resetearFormulario()
        {
            //limpiar mensajes
            for( const index in this.mensajeValidacion){
                this.mensajeValidacion[index] = ''
            }

            this.datosFormulario.estudiante_id      = '',
            this.datosFormulario.nombres            = '',
            this.datosFormulario.documento          = '',
            this.datosFormulario.codigo_estudiante  = '',
            this.datosFormulario.apellido_paterno   = '',
            this.datosFormulario.apellido_materno   = '',
            this.datosFormulario.fecha_nacimiento   = '',
            this.datosFormulario.estado_matricula   = '',
            this.datosFormulario.tipo_vacante       = '',
            this.datosFormulario.sexo               = '',
            this.datosFormulario.grado              = '',
            this.datosFormulario.seccion            = ''
        },
    }
}

</script>

<style>

</style>
