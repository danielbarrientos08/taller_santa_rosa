<template>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card" v-loading="loading"  element-loading-text="Verificando credenciales" >
                <div class="card-body p-4">
                    <div class="text-center w-75 m-auto">
                        <a href="#">
                            <span><img src="http://localhost:8000/img/logo2.png" alt="" height="70"></span>
                        </a>
                        <h4> SISTEMA DE MATRÍCULA TALLERES </h4>

                        <!-- <p class="text-muted mb-3 mt-3">Inicie sesíon para acceder.</p> -->
                    </div>

                    <h5 class="auth-title">Inicio de sesión </h5>

                    <form action="#" @submit.prevent="login" v-if="showForm">
                        <div class="form-group mb-3">
                            <label for="emailaddress">Usuario</label>
                            <el-input placeholder="Ingrese su usuario" type="text" v-model="fillFormLogin.usuario" required></el-input>
                            <small v-if="validationMessages.usuario != '' " v-text="validationMessages.usuario" class="text-danger"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Contraseña</label>
                            <el-input placeholder="Ingrese su contraseña" type="password" v-model="fillFormLogin.password" show-password  required></el-input>
                            <small v-if="validationMessages.password != '' " v-text="validationMessages.password" class="text-danger"></small>
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-info btn-block" type="submit"> Ingresar </button>
                        </div>
                    </form>
                    <div class="text-center m-2" v-if="generalMessage !=''" >
                        <div v-bind:class="[alertInfo ? 'alert-info' : 'alert-danger']" class="alert border-0" role="alert" >
                            <span v-text="generalMessage"></span>
                            <h1 v-text="timer" class="text-danger text-bold"></h1>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p> <a href="#" @click.prevent="forgotPassword()" class="text-muted ml-1">¿Olvidaste tu contraseña?</a></p>
                        </div> <!-- end col -->
                    </div>

                </div> <!-- end card-body -->
            </div>
            <!-- end card -->
            <!-- end row -->
        </div> <!-- end col -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            baseUrl: base_url,
            fillFormLogin:{
                usuario: '',
                password:''
            },
            validationMessages: {
                'usuario' : '',
                'password': ''
            },

            loading: false,
            alertInfo: false,
            generalMessage: '',
            timer: null,
            showForm: true
        }
    },
    methods:{
        login(){
            this.loading = true
            let url = this.baseUrl+'/login'

            axios.post(url,{
                'usuario': this.fillFormLogin.usuario,
                'password': this.fillFormLogin.password
            })
            .then(response =>{

                this.alertInfo = true
                this.generalMessage = 'Redireccionando ....'
                this.showForm = false
                location.href = base_url
            })
            .catch(error =>{
                if(error.response.status == 429) this.manyRequests();

                if(error.response.status == 401){
                    this.generalMessage ='Email o Contraseña incorrrecto'
                    this.fillFormLogin.Password = ''
                }

                if(error.response.status == 422){
                    let errors = error.response.data.errors
                    this.setValidationMessages(errors);
                }
            })
            .finally(() => this.loading = false);
        },
        manyRequests(){
            var me = this;
                me.timer = 60
                this.showForm = false

            setInterval(()=>{ if(me.timer>0) me.timer--; }, 1000);

            this.generalMessage = 'Ha realizado demasiados intentos fallidos, espere unos segundos para intentar nuevamente.'

            setTimeout(() => {
                location.reload();
            }, 60000);
        },
        setValidationMessages(errors)
        {
            //limpiar mensajes
            for(const index in this.validationMessages){
                this.validationMessages[index] = ''
            }
            //asignar nuevos mensajes
            for ( const index in errors) {
                this.validationMessages[index] = errors[index][0]
            }
        },
        forgotPassword(){
            location.href = base_url+'/forgotPassword'
        }
    },
}
</script>

<style>

</style>
