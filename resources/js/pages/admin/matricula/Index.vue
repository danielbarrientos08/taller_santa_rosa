<template>
      <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="col-12">
                                <div class="row">
                                    <h5 class="card-title mt-2 mr-2">Matrículas</h5>
                                    <button id="toggle" type="button" class="btn btn-outline-success btn-xs btn-rounded waves-effect waves-light mt-1 mb-1"><i class="fe-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="float-right" >



                                <button type="button" class="btn btn-xs btn-flat btn-light btn-width waves-effect waves-light"  @click.prevent="pageReload()" > <i class="fe-refresh-ccw"></i> Recargar</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="tools">
                                <fieldset>
                                    <legend> Filtros </legend>

                                    <form  @submit.prevent="listarMatriculas(1)"  v-loading="loading"  element-loading-text="Buscando..." >
                                        <div class="form-row">

                                             <div class="form-group col-2">
                                                <label for="inputZip" class="col-form-label">Cod. Taller</label>
                                                <input  type="text" class="form-control" placeholder="(opcional)" v-model="datosFormularioBusqueda.cod_taller">
                                            </div>
                                            <div class="form-group col-2">
                                                <label for="role" class="col-form-label">Taller</label>
                                                <el-select v-model="datosFormularioBusqueda.taller_id"  filterable placeholder="Seleccione" style="width:100%;">
                                                    <el-option
                                                        v-for="item in listaTalleres"
                                                        :key="item.taller_id"
                                                        :label="item.nombre"
                                                        :value="item.taller_id"
                                                    >
                                                    </el-option>
                                                </el-select>
                                            </div>
                                            <div class="form-group col-2">
                                                <label for="inputZip" class="col-form-label">N° Documento</label>
                                                <input  type="text" class="form-control" placeholder="(opcional)" v-model="datosFormularioBusqueda.documento_estudiante">
                                            </div>

                                             <div class="form-group col-2">
                                                <label for="role" class="col-form-label">Nivel</label>
                                                <el-select v-model="datosFormularioBusqueda.nivel" placeholder="Seleccione" style="width:100%;">
                                                    <el-option
                                                        v-for="item in listaNiveles"
                                                        :key="item.value"
                                                        :label="item.label"
                                                        :value="item.value"
                                                    >
                                                    </el-option>
                                                </el-select>
                                            </div>
                                            <div class="form-group col-2">
                                                <label for="role" class="col-form-label">Grado</label>
                                                <el-select v-model="datosFormularioBusqueda.grado" placeholder="Seleccione" style="width:100%;">
                                                    <el-option
                                                        v-for="item in listaGrados"
                                                        :key="item.value"
                                                        :label="item.label"
                                                        :value="item.value"
                                                    >
                                                    </el-option>
                                                </el-select>
                                            </div>

                                            <div class="col-2 mt-4">
                                                <button class="btn btn-xs pt-1 pb-1 btn-flat btn-info btn-width waves-effect waves-light " type="submit">  <i class="la la-search"></i> Buscar</button>
                                                <button class="btn btn-xs pt-1 pb-1 btn-flat btn-light btn-width waves-effect waves-light" type="button" @click.prevent="resetSearchForm()">Limpiar</button>
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                            <template v-if="listaMatriculas.length">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="float-right">
                                            <button type="button" @click="descargarReporte()" class="btn btn-xs btn-light text-danger mt-0"> Descargar Pdf <i class="far fa-lg fa-file-pdf"></i></button>
                                        </div> 
                                    </div>
                                </div>
                            </template>

                            <div class="table-responsive">
                                <fieldset>
                                    <legend> Registros </legend>
                                    <template v-if="listaMatriculas.length">
                                        <table class="table table-condensed table-sm table-hover mb-0" v-loading="loading"  element-loading-text="Cargando...">
                                            <thead class="thead-dark">
                                                <th class="text-light">DNI/CE</th>
                                                <th class="text-light">Apellidos y Nombres</th>
                                                <th class="text-light">Nivel</th>
                                                <th class="text-light">Grado</th>
                                                 <th class="text-light">Sección</th>
                                                <th class="text-light">Cod. taller</th>
                                                <th class="text-light">Nombre taller</th>
                                                <th class="text-light">Fecha de registro</th>
                                                <th class="text-light">Eliminar</th>

                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in listaMatriculas" :key="index">
                                                    <td v-text="item.ducumento_estudiante "></td>
                                                    <td v-text="item.estudiante.apellido_paterno +' '+ item.estudiante.apellido_materno +' '+item.estudiante.nombres "></td>
                                                    <td v-text="item.nivel"></td>
                                                    <td v-text="item.grado"></td>
                                                    <td v-text="item.seccion"></td>
                                                    <td v-text="item.cod_taller"></td>
                                                    <td v-text="item.taller.nombre"></td>
                                                    <td v-text="item.fecha_registro"></td>

                                                    <td>
                                                        <button class="btn btn-outline-danger btn-xs waves-effect waves-light" @click.prevent="eliminarMatricula(item.matricula_id,item.estudiante.nombres+' '+item.estudiante.apellido_paterno+' '+item.estudiante.apellido_materno)" title="Eliminar">
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
                            <div class="clearfix mb-2">
                                <div class="m-0 float-left">
                                    <span>Mostrando del <b>{{ pagination.from }}</b> al <b>{{ pagination.to }}</b> de <b> {{  pagination.total }} </b> registros</span>
                                </div>
                                <ul class="pagination  m-0 float-right">
                                    <li class="page-item"   :class="[pagination.currentPage == 1 ? 'disabled' : '']" >
                                        <a href="#" class="page-link" @click.prevent="selectPage(pagination.currentPage - 1)" ><i class="fe-chevron-left"></i>Anterior</a>
                                    </li>
                                    <el-select v-model="pagination.currentPage" @change="selectPage(pagination.currentPage)" class="page-item" filterable placeholder="Select">
                                        <el-option
                                            v-for="item in linksList"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value">
                                        </el-option>
                                    </el-select>
                                    <li class="page-item" :class="[pagination.currentPage < pagination.lastPage ? '' : 'disabled']" >
                                        <a href="#" class="page-link" @click.prevent="selectPage(pagination.currentPage + 1)">Siguiente<i class="fe-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </div><!-- end clearfix -->
                        </div> <!-- end col -->
                    </div><!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->


    </div><!-- end row-->
</template>

<script>
export default
{
    data()
    {
        return {
            datosFormularioBusqueda:{
                taller_id: '',
                cod_taller: '',
                documento_estudiante: '',
                nivel: '',
                grado: '',
                seccion: ''
            },
            listaMatriculas: [],
            listaTalleres: [],
            listaGrados: [
                {value: '',label:'TODOS'},
                {value: 'PRIMERO',label:'PRIMERO'},
                {value: 'SEGUNDO',label:'SEGUNDO'},
                {value: 'TERCERO',label:'TERCERO'},
                {value: 'CUARTO',label:'CUARTO'},
                {value: 'QUINTO',label:'QUINTO'},
                {value: 'SEXTO',label:'SEXTO'},
            ],
            listaNiveles: [
                {value: '',label:'TODOS'},
                {value: 'INICIAL',label:'INICIAL'},
                {value: 'PRIMARIA',label:'PRIMARIA'},
                {value: 'SECUNDARIA',label:'SECUNDARIA'},
            ],
            pagination:{
                currentPage: 0,
                lastPage:0,
                perPage:0,
                from:0,
                to:0,
                total:0,
            },
            loading: false,
            edicionIndex: null,
        }
    },

    mounted(){
        this.$nextTick(function () {
            //Código que se ejecutará solo después de haber renderizado la vista completa
            this.listarMatriculas(1);
        })

        EventBus.$on('actualizarMatricula', data =>{
            this.actualizarMatricula(data)
        })
    },
    methods:{
        resetSearchForm(){
            this.datosFormularioBusqueda = {
                taller_id: '',
                cod_taller: '',
                documento_estudiante: '',
                nivel: '',
                grado: '',
                seccion: ''
            };
        },
        selectPage(page)
        {
            this.pagination.currentPage = page;
            this.listarMatriculas(page)
        },
        crearMatricula()
        {
            EventBus.$emit('crearMatricula', '')
        },
        editarMatricula(id,index)
        {
            this.edicionIndex = index
            EventBus.$emit('editarMatricula', id)
        },
        eliminarMatricula(id,name)
        {
            Swal.fire({
                title: 'Eliminar matrícula',
                html: "¿Está seguro(a) de eliminar a: <b>"+ name+"</b>?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#f0643b",
                cancelButtonColor: "#98a6ad",
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.loading = true

                    let url = base_url +'/admin/matriculas/eliminar/'+id

                    axios.delete(url)
                    .then(response =>{
                        Swal.fire('Registro eliminado correctamente.','','success')
                        this.listarMatriculas(1);

                    })
                    .catch(error =>{
                        evaluateHttpResponse(error.response.status)

                        if(error.response.status == 409){
                            Swal.fire('No se pudo eliminar la matrícula.','Existen varios registros relacionados a esta matrícula.','','error');
                        }
                    })
                    .finally(() => this.loading = false);
                }
            })
        },
        descargarReporte(){
            this.loading = true

            let url = base_url +`/admin/matriculas/reportePdf?taller_id=${this.datosFormularioBusqueda.taller_id}&cod_taller=${this.datosFormularioBusqueda.cod_taller}&documento_estudiante=${this.datosFormularioBusqueda.documento_estudiante}&nivel=${this.datosFormularioBusqueda.nivel}&grado=${this.datosFormularioBusqueda.grado}&seccion=${this.datosFormularioBusqueda.seccion}`
            
            window.open(url, '_blank');
            // location.href= url
            this.loading = false;
        },
        actualizarMatricula(data)
        {
            this.listaMatriculas.splice(this.edicionIndex, 1, data);
        },
        listarMatriculas(page)
        {
            this.loading = true

            let url = base_url +'/admin/matriculas/listar?page='+page

            axios.get(url,{params:this.datosFormularioBusqueda})
            .then(response =>{

                this.listaTalleres = response.data.talleres
                this.listaTalleres.unshift({'taller_id':'','nombre':'TODOS'})
                let data = response.data.matriculas
                this.setDataPagination(data);
            })
            .catch(error =>{
                evaluateHttpResponse(error.response.status)
            })
            .finally(() => this.loading = false);
        },
        setDataPagination(data)
        {
            this.listaMatriculas = data.data

            this.pagination.to          = data.to
            this.pagination.from        = data.from
            this.pagination.total       = data.total
            this.pagination.perPage     = data.per_page
            this.pagination.lastPage    = data.last_page
            this.pagination.currentPage = data.current_page
        },
        pageReload()
        {
            location.reload()
        }

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
