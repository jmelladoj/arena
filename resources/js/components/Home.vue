<template>
    <div class="col-md-offset-2 col-md-8">
        <div class="row alert alert-danger" v-show="estadoErrores">
            <div class="text-left">
                <li v-for="error in errores" :key="error" v-text="error"></li>
            </div>
        </div>

        <div class="row bottom5" v-show="registro == 0">
            <button @click="boton = 1" v-show="boton == 0" class="btn btn-block btn_common yellow text-right">INDIVUAL</button>
            <button v-for="categoriasB in arrayCategoriasBasicas" :key="categoriasB.id" v-text="categoriasB.nombre" class="btn btn-block btn_common yellow text-right" v-show="boton == 1" @click="mostrarFormulario(1, categoriasB.id)"></button>
        
            <div class="col-md-12" v-show="formulario == 1">
                <form class="form-inline findus" id="contact-form">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <h3>Datos</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Run" v-rut v-model="run[0]" required>
                            </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nombre y Apellido" v-model="nombre[0]" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <select class="form-control p-0" v-model="polera_id[0]" required>
                                <option value="0">Talla de polera</option>
                                <option v-for="polera in arrayPoleras" :key="polera.id" :value="polera.id" v-text="polera.talla"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" v-model="email" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Box" v-model="box">
                        </div>
                    </div>
                    <div class="col-md-12" v-show="categoria_id == 5">
                        <div class="form-group">
                            <input type="date" class="form-control" placeholder="Fecha de nacimiento" v-model="fecha_nacimiento" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <button @click="registrarse()" class="btn btn-block btn-success btn_common text-right">Registrarse con Mercado Pago</button>
                            <button @click="registrarseWebpay()" class="btn btn-block btn-info btn_common text-right">Registrarse con Web Pay</button>
                        </div>
                    </div>

                    </div>
                </form>
            </div>
        </div>
        
        <div class="row bottom5" v-show="registro == 0">
            <button @click="boton = 3" v-show="boton == 0" class="btn btn-block btn_common yellow text-right">TRÍOS</button>
            <button v-for="categoriaT in arrayCategoriasTrios" :key="categoriaT.id" v-text="categoriaT.nombre" class="btn btn-block btn_common yellow text-right" v-show="boton == 3" @click="mostrarFormulario(3, categoriaT.id)"></button>
        
            <div class="col-md-12" v-show="formulario == 3">
                <form class="form-inline findus" id="contact-form" onSubmit="return false">
                    <div class="row top15">
                        <div class="col-md-12 col-sm-12">
                            <h3>Integrante 1 - Representante</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre y Apellido" required v-model="nombre[0]">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Run"  v-rut required v-model="run[0]">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <select class="form-control p-0" required v-model="polera_id[0]">
                                    <option value="0">Talla de polera</option>
                                    <option v-for="polera in arrayPoleras" :key="polera.id" :value="polera.id" v-text="polera.talla"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email encargado"  required v-model="email">
                            </div>
                        </div>
                    </div>
                    <div class="row top15">
                        <div class="col-md-12 col-sm-12">
                            <h3>Integrante 2</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre y Apellido" required v-model="nombre[1]">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Run"  v-rut required v-model="run[1]">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <select class="form-control p-0" required v-model="polera_id[1]">
                                    <option value="0">Talla de polera</option>
                                    <option v-for="polera in arrayPoleras" :key="polera.id" :value="polera.id" v-text="polera.talla"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row top15">
                        <div class="col-md-12 col-sm-12">
                            <h3>Integrante 3</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre y Apellido" required v-model="nombre[2]">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Run"  v-rut required v-model="run[2]">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <select class="form-control p-0" required v-model="polera_id[2]">
                                    <option value="0">Talla de polera</option>
                                    <option v-for="polera in arrayPoleras" :key="polera.id" :value="polera.id" v-text="polera.talla"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row top15">
                        <div class="col-md-12 col-sm-12">
                            <h3>Datos Generales</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre de equipo" required v-model="nombre_equipo">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <button @click="registrarse()" class="btn btn-block btn-success btn_common text-right">Registrarse</button>
                            <button @click="registrarseWebpay()" class="btn btn-block btn-info btn_common text-right">Registrarse con Web Pay</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row bottom5" v-show="registro == 0">
            <button @click="boton = 2" v-show="boton == 0" class="btn btn-block btn_common yellow text-right">DUPLAS BÁSICO</button>
            <button v-for="categoriaD in arrayCategoriasDuplas" :key="categoriaD.id" v-text="categoriaD.nombre" class="btn btn-block btn_common yellow text-right" v-show="boton == 2" @click="mostrarFormulario(2, categoriaD.id)"></button>
        
            <div class="col-md-12" v-show="formulario == 2">
                <form class="form-inline findus" id="contact-form" onSubmit="return false">
                    <div class="row top15">
                        <div class="col-md-12 col-sm-12">
                            <h3>Integrante 1 - Representante</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre y Apellido" v-model="nombre[0]" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Run"  v-rut v-model="run[0]" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <select class="form-control p-0" v-model="polera_id[0]" required>
                                    <option value="0">Talla de polera</option>
                                    <option v-for="polera in arrayPoleras" :key="polera.id" :value="polera.id" v-text="polera.talla"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email encargado"  v-model="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row top15">
                        <div class="col-md-12 col-sm-12">
                            <h3>Integrante 2</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre y Apellido" v-model="nombre[1]" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Run"  v-rut v-model="run[1]" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <select class="form-control p-0" v-model="polera_id[1]" required>
                                    <option value="0">Talla de polera</option>
                                    <option v-for="polera in arrayPoleras" :key="polera.id" :value="polera.id" v-text="polera.talla"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row top15">
                        <div class="col-md-12 col-sm-12">
                            <h3>Datos Generales</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre de dupla" v-model="nombre_equipo" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <button @click="registrarse()" class="btn btn-block btn-success btn_common text-right">Registrarse</button>
                            <button @click="registrarseWebpay()" class="btn btn-block btn-info btn_common text-right">Registrarse con Web Pay</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row" v-show="registro == 1">
            <div class="col-md-12 text-center wow bounceIn margin_top" id="app">    
                <h2 style="font-weight: 600;" class="top50 whitecolor text-center">!! MUCHAS GRACIAS ¡¡</h2> 
                <br><br>
                <h3 style="font-weight: 600;" class="top30 whitecolor text-center"> 
                    ESPERE POR FAVOR ...
                </h3>
            </div>
        </div>

        <div class="row" v-show="registro == 2">
            <div class="col-md-12 text-center wow bounceIn margin_top" id="app">    
                <h2 style="font-weight: 600;" class="top50 whitecolor text-center">!! MUCHAS GRACIAS ¡¡</h2>
                <br><br>
                <h3 style="font-weight: 600;" class="top30 whitecolor text-center"> 
                    YA TIENES UN CUPO EN EL TORNEO ARENA 2019, <br> ENVÍAMOS UN EMAIL DE CONFIRMACIÓN <br>, ESTE TAMBIEN PUEDE LLEGAR A SPAM, <br> PARA QUE PUEDAS TERMINAR LA INSCRIPCIÓN. <br> NO OLVIDES SEGUIR NUESTRAS <br>  REDES SOCIALES PARA NO <br> PERDERTE NINGÚN DETALLE O SORPRESA.
                </h3>
                <ul class="social_icon black top25 bottom20">
                <li><a href="https://www.facebook.com/Torneo-Arena-326242074680970/" class="facebook" target="__blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/torneoarena/" class="instagram" target="__blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <center style="padding: 0;"><button class="border_radius btn_common blue" @click="volverAtras()">Volver a inscripciones</button></center>
            </div>
        </div>
        <br>
        <div class="row top5" v-show="boton != 0"><button @click="volverAtras()" class="btn btn_common yellow text-right">VOLVER ATRÁS</button></div>
    </div>
</template>

<script>
    import Vue from 'vue';
    import { rutInputDirective } from 'vue-dni';

    Vue.directive('rut', rutInputDirective);

    export default {
        data (){
            return {
                boton: 0,
                formulario: 0,
                arrayCategoriasBasicas : [],
                arrayCategoriasDuplas : [],
                arrayCategoriasTrios : [],
                arrayPoleras : [],
                run: [],
                nombre: [],
                email: '',
                polera_id: [],
                box: '',
                nombre_equipo: '',
                categoria_id: 0,
                fecha_nacimiento: '',
                errores:[],
                estadoErrores: 0,
                registro: 0,
                created () {
                    Validator.extend('rut', rutValidator)
                }
            }
        },
        methods : {
            registrarse(){
                let me = this;

                if(this.formulario == 1 && this.validarIndividual()){
                    return;
                } else if(this.formulario == 3 && this.validarTrio()){
                    return;
                } else if(this.formulario == 2 && this.validarDupla()){
                    return;
                }

                me.registro = 1;

                axios.post('/atleta/registrar',{
                    'run': this.run,
                    'nombre': this.nombre,
                    'email': this.email,
                    'polera_id': this.polera_id,
                    'box': this.box,
                    'nombre_equipo': this.nombre_equipo,
                    'categoria_id': this.categoria_id,
                    'fecha_nacimiento': this.fecha_nacimiento
                }).then(function (response) {
                    me.listarCategoria();
                    me.volverAtras();
                    me.registro = 2;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            registrarseWebpay(){
                let me = this;

                if(this.formulario == 1 && this.validarIndividual()){
                    return;
                } else if(this.formulario == 3 && this.validarTrio()){
                    return;
                } else if(this.formulario == 2 && this.validarDupla()){
                    return;
                }

                me.registro = 1;

                axios.post('/atleta/registrar/wepay',{
                    'run': this.run,
                    'nombre': this.nombre,
                    'email': this.email,
                    'polera_id': this.polera_id,
                    'box': this.box,
                    'nombre_equipo': this.nombre_equipo,
                    'categoria_id': this.categoria_id,
                    'fecha_nacimiento': this.fecha_nacimiento
                }).then(function (response) {
                    me.listarCategoria();
                    me.volverAtras();

                    var form = document.createElement("form");
                    var input_token = document.createElement("input");

                    form.method = "POST";
                    form.action = response.data.url;

                    input_token.value = response.data.token;
                    input_token.name = "TBK_TOKEN";
                    
                    form.appendChild(input_token);
                    document.body.appendChild(form);
                    form.submit();

                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarIndividual(){
                this.estadoErrores=0;
                this.errores =[];

                if (!this.nombre.length) this.errores.push("Debes ingresar un nombre");
                if (!this.run.length) this.errores.push("Debes ingresar un run");
                if (!this.polera_id[0]) this.errores.push("Debes seleccionar una polera");
                if (!this.email) this.errores.push("Debes ingresar un mail");
                if (!this.email.includes('.') || !this.email.includes('@')) this.errores.push("Debes ingresar un mail valido");

                if(this.categoria_id == 5){
                    if (!this.fecha_nacimiento) this.errores.push("Debes ingresar tu fecha de nacimiento");
                }

                if (this.errores.length) this.estadoErrores = 1;

                return this.estadoErrores;
            },
            validarTrio(){
                this.estadoErrores=0;
                this.errores =[];

                if(!this.nombre.length){
                    this.errores.push("Falta Ingresar run de atletas");
                } else {
                    if (!this.run[0]) this.errores.push("Falta run de atleta uno");
                    if (!this.run[1]) this.errores.push("Falta run de atleta dos");
                    if (!this.run[2]) this.errores.push("Falta run de atleta tres");
                }

                if(!this.nombre.length){
                    this.errores.push("Falta Ingresar nombres");
                } else {
                    if (!this.nombre[0]) this.errores.push("Falta nombre de atleta uno");
                    if (!this.nombre[1]) this.errores.push("Falta nombre de atleta dos");
                    if (!this.nombre[2]) this.errores.push("Falta nombre de atleta tres");
                }

                if(!this.polera_id.length){
                    this.errores.push("Falta seleccionar poleras");
                } else {
                    if (!this.polera_id[0]) this.errores.push("Falta polera de atleta uno");
                    if (!this.polera_id[1]) this.errores.push("Falta polera de atleta dos");
                    if (!this.polera_id[2]) this.errores.push("Falta polera de atleta tres");
                }

                if (!this.email) this.errores.push("Falta ingresar un mail");
                if (!this.email.includes('.') || !this.email.includes('@')) this.errores.push("Debes ingresar un mail valido");
                if (!this.nombre_equipo) this.errores.push("Falta ingresar un nombre de equipo");

                if (this.errores.length) this.estadoErrores = 1;

                return this.estadoErrores;
            },
            validarDupla(){
                                this.estadoErrores=0;
                this.errores =[];

                if(!this.nombre.length){
                    this.errores.push("Falta Ingresar run de atletas");
                } else {
                    if (!this.run[0]) this.errores.push("Falta run de atleta uno");
                    if (!this.run[1]) this.errores.push("Falta run de atleta dos");
                }

                if(!this.nombre.length){
                    this.errores.push("Falta Ingresar nombres");
                } else {
                    if (!this.nombre[0]) this.errores.push("Falta nombre de atleta uno");
                    if (!this.nombre[1]) this.errores.push("Falta nombre de atleta dos");
                }

                if(!this.polera_id.length){
                    this.errores.push("Falta seleccionar poleras");
                } else {
                    if (!this.polera_id[0]) this.errores.push("Falta polera de atleta uno");
                    if (!this.polera_id[1]) this.errores.push("Falta polera de atleta dos");
                }

                if (!this.email) this.errores.push("Falta ingresar un mail");
                if (!this.email.includes('.') || !this.email.includes('@')) this.errores.push("Debes ingresar un mail valido");
                if (!this.nombre_equipo) this.errores.push("Falta ingresar un nombre de equipo");

                if (this.errores.length) this.estadoErrores = 1;

                return this.estadoErrores;
            },
            volverAtras(){
                this.formulario = 0;
                this.boton = 0;
                this.categoria_id = 0;
                this.run = [];
                this.nombre= [];
                this.email = '';
                this.polera_id= [];
                this.box = '';
                this.nombre_equipo = '';
                this.categoria_id = 0;
                this.fecha_nacimiento = '';
                this.estadoErrores = 0;
                this.registro = 0;
            },
            mostrarFormulario(indice, id){
                this.formulario = indice;
                this.boton = 4;
                this.categoria_id = id;

                if(indice == 1){
                    this.polera_id[0] = 0;
                } else if(indice == 2){
                    this.polera_id[0] = 0;
                    this.polera_id[1] = 0;
                } else if(indice == 3){
                    this.polera_id[0] = 0;
                    this.polera_id[1] = 0;
                    this.polera_id[2] = 0;
                }
            },
            listarCategoria (){
                let me=this;
                var url= '/obtenerCategorias';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;

                    me.arrayCategoriasBasicas = respuesta.categoriasBasicas;
                    me.arrayCategoriasDuplas = respuesta.categoriasDuplas;
                    me.arrayCategoriasTrios = respuesta.categoriasTrios;
                })
                .catch(function (error) {
                    console.log(error.response.data.errors);
                });
            },
            listarPoleras (){
                let me=this;
                var url= '/obtenerPoleras';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPoleras = respuesta.poleras;
                })
                .catch(function (error) {
                    console.log(error.response.data);
                    errores = error.response.data.errors;
                });
            }
        },
        mounted() {
            this.listarCategoria();
            this.listarPoleras();
        }
    }
</script>

<style>    
    .alert{
        padding-left: 25px;
    }
</style>
