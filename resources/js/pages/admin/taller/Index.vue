<template>
      <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="col-12">
                                <div class="row">
                                    <h5 class="card-title mt-2 mr-2">Registro de talleres</h5>
                                    <button id="toggle" type="button" class="btn btn-outline-success btn-xs btn-rounded waves-effect waves-light mt-1 mb-1"><i class="fe-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="float-right" >

                                    <button type="button" class="btn btn-xs btn-flat btn-success btn-width" @click.prevent="crearTaller()">
                                        <i class="fe-plus-circle"></i> Nuevo
                                    </button>

                                <button type="button" class="btn btn-xs btn-flat btn-light btn-width waves-effect waves-light"  @click.prevent="pageReload()" > <i class="fe-refresh-ccw"></i> Recargar</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="tools">
                                <fieldset>
                                    <legend> Filtros </legend>

                                    <form  @submit.prevent="listarTalleres(1)"  v-loading="loading"  element-loading-text="Buscando..." >
                                        <div class="form-row">

                                            <div class="form-group col-3">
                                                <label for="inputZip" class="col-form-label">Cod. taller</label>
                                                <input  type="text" class="form-control" placeholder="Ingrese nombres o apellidos" v-model="datosFormularioBusqueda.cod_taller">
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="inputZip" class="col-form-label">Nombre taller</label>
                                                <input  type="text" class="form-control" placeholder="Ingrese nombres o apellidos" v-model="datosFormularioBusqueda.nombre">
                                            </div>

                                            <div class="form-group col-2">
                                                <label for="role" class="col-form-label">Estado</label>
                                                <el-select v-model="datosFormularioBusqueda.estado" placeholder="Seleccione" style="width:100%;">
                                                    <el-option
                                                        v-for="item in listaEstados"
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
                            <div class="table-responsive">
                                <fieldset>
                                    <legend> Registros </legend>
                                    <template v-if="listaTalleres.length">
                                        <table class="table table-condensed table-sm table-hover mb-0" v-loading="loading"  element-loading-text="Cargando...">
                                            <thead class="thead-dark">
                                                <th class="text-light">Cod. taller</th>
                                                <th class="text-light">Nombre taller</th>
                                                <th class="text-light">vacantes</th>
                                                <th class="text-light">estado</th>
                                                <th class="text-light">Editar</th>
                                                <th class="text-light">Eliminar</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in listaTalleres" :key="index">
                                                    <td v-text="item.cod_taller "></td>
                                                    <td v-text="item.nombre"></td>
                                                    <td v-text="item.vacantes"></td>
                                                    <td>
                                                        <template v-if="item.estado=='Activo'">
                                                            <span class="badge badge-success">{{item.estado}}</span>
                                                        </template>
                                                        <template v-else>
                                                             <span class="badge badge-warning">{{item.estado}}</span>
                                                        </template>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-primary btn-xs waves-effect waves-light" @click.prevent="editarTaller(item.taller_id,index)" title="Editar">
                                                            <i class="fe-edit"></i>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-danger btn-xs waves-effect waves-light" @click.prevent="eliminarTaller(item.taller_id,item.nombre)" title="Eliminar">
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

        <taller-crear></taller-crear>
    </div><!-- end row-->
</template>

<script>
import TallerCrear from './Crear'

export default
{
    components:{TallerCrear},

    data()
    {
        return {
            datosFormularioBusqueda:{
                cod_taller: '',
                nombre: '',
                grupo: '',
                estado:''
            },
            listaTalleres: [],
            listaGrupos: [
                {value: '',label:'TODOS'},
                {value: '1',label:'LUNES-MIÉRCOLES'},
                {value: '1',label:'MARTES-JUEVES'},

            ],
            listaEstados: [
                {value: '',label:'TODOS'},
                {value: 'Activo',label:'Activo'},
                {value: 'Inactivo',label:'Inactivo'},
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
            this.listarTalleres(1);
        })

        EventBus.$on('actualizarTaller', data =>{
            this.actualizarTaller(data)
        })
    },
    methods:{
        selectPage(page)
        {
            this.pagination.currentPage = page;
            this.listarTalleres(page)
        },
        crearTaller()
        {
            EventBus.$emit('crearTaller', '')
        },
        editarTaller(id,index)
        {
            this.edicionIndex = index
            EventBus.$emit('editarTaller', id)
        },
        eliminarTaller(id,name)
        {
            Swal.fire({
                title: 'Eliminar Taller',
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

                    let url = base_url +'/admin/talleres/eliminar'

                    axios.delete(url,{
                        params:{
                            taller_id:id
                        }
                    })
                    .then(response =>{
                        Swal.fire('Taller eliminado correctamente.','','success')
                        this.listarTalleres(1);

                    })
                    .catch(error =>{
                        evaluateHttpResponse(error.response.status)

                        if(error.response.status == 409){
                            Swal.fire('No se pudo eliminar al taller.','Existen varios registros relacionados a este Taller.','error');
                        }
                    })
                    .finally(() => this.loading = false);
                }
            })
        },

        actualizarTaller(data)
        {
            this.listaTalleres.splice(this.edicionIndex, 1, data);
        },
        listarTalleres(page)
        {
            this.loading = true

            let url = base_url +'/admin/talleres/listar?page='+page

            axios.get(url,{params:this.datosFormularioBusqueda})
            .then(response =>{
                let data = response.data.response
                this.setDataPagination(data);
            })
            .catch(error =>{
                evaluateHttpResponse(error.response.status)
            })
            .finally(() => this.loading = false);
        },
        setDataPagination(data)
        {
            this.listaTalleres = data.data

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
        },
        resetSearchForm(){
            this.datosFormularioBusqueda = {
                cod_taller: '',
                nombre: '',
                grupo: '',
                estado:''
            };
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
