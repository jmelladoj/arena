<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Atletas</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Atletas</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div v-show="estadoAtleta" class="form-group row alert alert-success">
                                <div class="text-left">
                                    <li v-for="estado in estados" :key="estado" v-text="estado"></li>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" v-model="criterio">
                                            <option value="run">Run</option>
                                            <option value="nombre">Nombre</option>
                                            <option value="correo">Correo</option>
                                            <option value="nombre_equipo">Equipo</option>
                                        </select>
                                        <input type="text" v-model="buscar" @keyup.enter="listarAtleta(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarAtleta(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="display nowrap table table-hover table-striped table-bordered">
                                    <thead align="center">
                                        <th>NUM</th>
                                        <th>RUN</th>
                                        <th>NOMBRE</th>
                                        <th>CORREO</th>
                                        <th>EQUIPO</th>
                                        <th>ENCARGADO</th>
                                        <th>POLERA</th>
                                        <th>ACCIONES</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="atleta in arrayAtleta" :key="atleta.id">
                                            <td v-text="atleta.id" align="center"></td>
                                            <td v-text="atleta.run"></td>
                                            <td v-text="atleta.nombre"></td>
                                            <td v-text="atleta.correo"></td>
                                            <td v-text="atleta.nombre_equipo" align="center"></td>
                                            <td align="center"><label v-if="atleta.encargado">SÍ</label><label v-else>NO</label></td>
                                            <td v-text="atleta.polera.talla" align="center"></td>
                                            <td align="center">
                                                <button type="button" @click="abrirModal('atleta','actualizar',atleta)" class="btn btn-warning btn-xs">
                                                    <i class="icon-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-xs" @click="eliminarAtleta(atleta.id)">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </td>
                                        </tr>                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" :class="{'mostrar' : modal}" style="display: none;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div v-show="errorAtleta" class="form-group row alert alert-danger">
                                <div class="text-left">
                                    <li v-for="error in errores" :key="error" v-text="error"></li>
                                </div>
                            </div>
                            <form class="floating-labels m-t-20">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <input type="text" class="form-control" v-model="nombre">
                                            <span class="bar"></span>
                                            <label for="nombre">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <input type="email" class="form-control" v-model="correo">
                                            <span class="bar"></span>
                                            <label for="correo">Correo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <input type="text" class="form-control" v-model="nombre_equipo">
                                            <span class="bar"></span>
                                            <label for="equipo">Equipo</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <select class="form-control p-0" v-model="polera_id">
                                                <option v-for="polera in arrayPolera" :key="polera.id" :value="polera.id" v-text="polera.talla"></option>
                                            </select><span class="bar"></span>
                                            <label for="input6">Talla polera</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarAtleta()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</template>

<script>
    export default {
        data (){
            return {
                atleta_id: 0,
                nombre : '',
                correo : '',
                nombre_equipo : '',
                polera_id : 0,
                arrayAtleta : [],
                arrayPolera : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                estadoAtleta: 0,
                estados : [],
                errorAtleta : 0,
                errores : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarAtleta (page,buscar,criterio){
                let me=this;
                var url= '/atletas?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayAtleta = respuesta.atletas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error.response.data);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarAtleta(page,buscar,criterio);
            },
            actualizarAtleta(){
                this.errores =[];

                if (this.validarAtleta()){
                    return;
                }
                
                let me = this;

                axios.put('/atleta/actualizar',{
                    'nombre': this.nombre,
                    'correo': this.correo,
                    'nombre_equipo': this.nombre_equipo,
                    'polera_id': this.polera_id,
                    'id': this.atleta_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAtleta(1,'','nombre');
                    me.statusAtleta(2);
                }).catch(function (error) {
                    console.log(error.response.data);
                }); 
            },
            eliminarAtleta(id){
               swal({
                title: '¿Esta seguro de eliminar este atleta?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/atleta/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarAtleta(1,'','nombre');
                        swal(
                        'Atleta eliminado!',
                        'El registro ha sido eliminado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error.response.data);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            seleccionarPolera(){
                let me=this;
                var url= '/polera/seleccionarPolera';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayPolera = respuesta.poleras;
                })
                .catch(function (error) {
                    console.log(error.response.data);
                });
            },
            validarAtleta(){
                this.errorAtleta=0;
                this.errores =[];

                if (!this.nombre) this.errores.push("El nombre de la atleta no puede estar vacío.");
                if (this.valor < 0) this.errores.push("El valor debe ser mayor o igual a 0.");
                if (this.hombres < 0) this.errores.push("La cantidad de atletas hombre debe ser mayor o igual a 0.");
                if (this.mujeres < 0) this.errores.push("La cantidad de atletas mujer debe ser mayor o igual a 0.");
                if (this.errores.length) this.errorAtleta = 1;

                return this.errorAtleta;
            },
            statusAtleta(estado){
                this.estadoAtleta = 0;
                this.estados = [];

                if(estado == 1){
                    this.estados.push('Registro agregado exitosamente');
                } else if(estado == 2){
                    this.estados.push('Registro actualizo exitosamente');
                }

                if (this.estados.length) this.estadoAtleta = 1;

                return this.estadoAtleta;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.correo = '';
                this.nombre_equipo = '';
                this.polera_id = 0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "atleta":
                    {
                        switch(accion){
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar atleta';
                                this.tipoAccion = 2;
                                this.atleta_id = data['id'];
                                this.nombre = data['nombre'];
                                this.correo = data['correo'];
                                this.nombre_equipo = data['nombre_equipo'];
                                this.polera_id = data['polera_id'];
                                break;
                            }
                        }
                    }
                }
                this.seleccionarPolera();
            }
        },
        mounted() {
            this.listarAtleta(1,this.buscar,this.criterio);
        }
    }
</script>

<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: fixed !important;
        background-color: #000000b3 !important;
    }

    .table td{
        padding: 0.30rem;
    }

    .table th{
        padding: 0.50rem;
    }
</style>
