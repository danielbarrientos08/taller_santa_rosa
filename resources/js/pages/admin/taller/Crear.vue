<template>
    <div class="modal fade" id="tallerCreateModal" tabindex="-1" aria-labelledby="tallerCreateModalLabel" aria-hidden="true">
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
                            <div class="form-group col-md-4">
                                <label  class="col-form-label">Cod. taller</label>
                                <input  type="text" class="form-control" placeholder="Ingrese dcod. taller " v-model="datosFormulario.cod_taller" required maxlength="14">
                                <small v-if="mensajeValidacion.cod_taller != '' " v-text="mensajeValidacion.cod_taller" class="text-danger"></small>
                            </div>
                           <div class="form-group col-md-8">
                                <label  class="col-form-label">Nombre taller</label>
                                <input  type="text" class="form-control" placeholder="Ingrese nombre del taller " v-model="datosFormulario.nombre" required maxlength="40">
                                <small v-if="mensajeValidacion.nombre != '' " v-text="mensajeValidacion.nombre" class="text-danger"></small>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity" class="col-form-label">Vacantes</label>
                                <input type="text" placeholder="Ingrese cantidad de vacantes" class="form-control" v-model="datosFormulario.vacantes" required maxlength="40">
                                <small v-if="mensajeValidacion.vacantes != '' " v-text="mensajeValidacion.vacantes" class="text-danger"></small>
                            </div>

                            <div class="form-group col-md-6">
                                <label  class="col-form-label">Estado</label>
                                <el-select v-model="datosFormulario.estado" placeholder="Seleccione"  style="width:100%;" required >
                                    <el-option
                                        v-for="item in listaEstados"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                    >
                                    </el-option>
                                </el-select>
                                <small v-if="mensajeValidacion.estado != '' " v-text="mensajeValidacion.estado" class="text-danger"></small>
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
                taller_id:'',
                cod_taller: '',
                nombre: '',
                vacantes: '',
                grupo: '',
                estado: ''
            },
            mensajeValidacion: {
                taller_id:'',
                cod_taller: '',
                nombre: '',
                vacantes: '',
                grupo: '',
                estado: ''
            },
             listaGrupos: [
                {value: '',label:'TODOS'},
                {value: '1',label:'LUNES-MIÉRCOLES'},
                {value: '1',label:'MARTES-JUEVES'},

            ],
            listaEstados: [
                {value: 'Activo',label:'Activo'},
                {value: 'Inactivo',label:'Inactivo'},
            ],
            loading: false,
            tituloModal:''
        }
    },
    mounted(){
        this.$nextTick(function () {
        })

        EventBus.$on('crearTaller', data =>{
            console.log('recivido');
            this.tituloModal = 'Nuevo taller'
            $('#tallerCreateModal').modal('toggle');
            this.resetearFormulario()
        })

        EventBus.$on('editarTaller', data =>{
            this.editarTaller(data)
            this.resetearFormulario()
        })
    },
    methods: {

        editarTaller(id)
        {
            let url = base_url +'/admin/talleres/obtener/'+id

            axios.get(url)
            .then(response =>{
                let data = response.data.response
                //asignar valores
                this.datosFormulario =  data
                this.tituloModal = 'Editar taller'
                $('#tallerCreateModal').modal('toggle');
            })
            .catch(error =>{
                evaluateHttpResponse(error.response.status)
            })
        },

        submitForm()
        {
            if(this.datosFormulario.taller_id != '')
                this.actualizarTaller()
            else
                this.crearTaller()
        },
        crearTaller()
        {
            this.loading = true
            let url = base_url +'/admin/talleres/crear'

            axios.post(url,this.datosFormulario)
            .then(response =>{

                this.resetearFormulario();

                Swal.fire({
                    title: 'Taller registrado correctamente',
                    text: '¿Desea registrar un nuevo taller ?',
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
                        $('#tallerCreateModal').modal('toggle');
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
        actualizarTaller()
        {
            this.loading = true

            let url = base_url +'/admin/talleres/actualizar'

            axios.put(url,this.datosFormulario)
            .then(response =>{
                let data = response.data.response

                $('#tallerCreateModal').modal('toggle');

                Swal.fire('!Cambios realizados correctamente!','','success')
                EventBus.$emit('actualizarTaller', data)
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

            this.datosFormulario = {
                taller_id:'',
                cod_taller: '',
                nombre: '',
                vacantes: '',
                grupo: '',
                estado: ''
            }

        },
    }
}

</script>

<style>

</style>
