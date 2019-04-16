<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Atletas Pendientes</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Atletas Pendientes</li>
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
                                <template>
                                    <div class="table-responsive">
                                        <b-container fluid>
                                            <!-- User Interface controls -->
                                            <b-row>
                                            <b-col md="6" class="my-1">
                                                <b-form-group label-cols-sm="3" label="Filtrar" class="mb-0">
                                                <b-input-group>
                                                    <b-form-input v-model="filter" placeholder="Escribe para buscar" />
                                                    <b-input-group-append>
                                                    <b-button :disabled="!filter" @click="filter = ''">Limpiar</b-button>
                                                    </b-input-group-append>
                                                </b-input-group>
                                                </b-form-group>
                                            </b-col>

                                            <b-col md="6" class="my-1">
                                                <b-form-group label-cols-sm="3" label="Ordenar" class="mb-0">
                                                <b-input-group>
                                                    <b-form-select v-model="sortBy" :options="sortOptions">
                                                    <option slot="first" :value="null">-- nada --</option>
                                                    </b-form-select>
                                                    <b-form-select :disabled="!sortBy" v-model="sortDesc" slot="append">
                                                    <option :value="false">Asc</option> <option :value="true">Desc</option>
                                                    </b-form-select>
                                                </b-input-group>
                                                </b-form-group>
                                            </b-col>

                                            <b-col md="6" class="my-1">
                                                <b-form-group label-cols-sm="3" label="Dirección" class="mb-0">
                                                <b-input-group>
                                                    <b-form-select v-model="sortDirection" slot="append">
                                                    <option value="asc">Asc</option> <option value="desc">Desc</option>
                                                    <option value="last">Último</option>
                                                    </b-form-select>
                                                </b-input-group>
                                                </b-form-group>
                                            </b-col>

                                            <b-col md="6" class="my-1">
                                                <b-form-group label-cols-sm="3" label="Por página" class="mb-0">
                                                <b-form-select :options="pageOptions" v-model="perPage" />
                                                </b-form-group>
                                            </b-col>
                                            </b-row>

                                            <!-- Main table element -->
                                            <b-table class="table table-hover table-striped"
                                            show-empty
                                            responsive="md" 
                                            :items="arrayAtleta"
                                            :fields="fields"
                                            :current-page="currentPage"
                                            :per-page="perPage"
                                            :filter="filter"
                                            :sort-by.sync="sortBy"
                                            :sort-desc.sync="sortDesc"
                                            :sort-direction="sortDirection"
                                            @filtered="onFiltered"
                                            >

                                            <template slot="encargado" slot-scope="row">
                                                <label v-if="row.item.encargado == 1">SÍ</label><label v-else>NO</label>
                                            </template>

                                            <template slot="acciones" slot-scope="row">
                                                <b-button size="xs" @click="abrirModal('atleta','actualizar',row.item)" class="btn btn-warning">
                                                    <i class="icon-pencil"></i>
                                                </b-button>

                                                <!--<b-button size="xs" @click="eliminarAtleta(row.item.id)" class="btn btn-danger">
                                                    <i class="icon-trash"></i>
                                                </b-button>-->
                                            </template>

                                            </b-table>

                                            <b-row>
                                            <b-col md="6" class="my-1">
                                                <b-pagination
                                                :total-rows="totalRows"
                                                :per-page="perPage"
                                                v-model="currentPage"
                                                class="my-0"
                                                />
                                            </b-col>
                                            </b-row>
                                        </b-container>
                                    </div>
                                    
                                </template>
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
                            <form class="for m-t-20">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" v-model="nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="correo">Correo</label>
                                            <input type="email" class="form-control" v-model="correo">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="equipo">Equipo</label>
                                            <input type="text" class="form-control" v-model="nombre_equipo">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="input6">Talla polera</label>
                                            <select class="form-control p-0" v-model="polera_id">
                                                <option v-for="polera in arrayPolera" :key="polera.id" :value="polera.id" v-text="polera.talla"></option>
                                            </select>
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
    import BootstrapVue from 'bootstrap-vue'

    Vue.use(BootstrapVue)

    const items = [
        { isActive: true, age: 40, name: { first: 'Dickerson', last: 'Macdonald' } }
    ]

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
                items: items,
                fields: [
                    { key: 'id', label: 'NUM', sortable: true, sortDirection: 'desc', class: 'text-center' },
                    { key: 'run', label: 'RUN', sortable: true, class: 'text-left' },
                    { key: 'correo', label: 'CORREO', sortable: true, class: 'text-left' },
                    { key: 'categoria.nombre', label: 'CATEGORÍA', sortable: true, class: 'text-left' },
                    { key: 'categoria.nombre_categoria', label: 'TIPO', sortable: true, class: 'text-left' },
                    { key: 'box', label: 'BOX', sortable: true, class: 'text-left' },
                    { key: 'nombre_equipo', label: 'EQUIPO', sortable: true, class: 'text-left' },
                    { key: 'encargado', label: 'ENCARGADO', sortable: true, class: 'text-left' },
                    { key: 'polera.talla', label: 'POLERA', sortable: true, class: 'text-left' },
                    { key: 'acciones', label: 'ACCIONES', sortable: true, class: 'text-center' }
                ],
                currentPage: 1,
                perPage: 10,
                totalRows: 0,
                pageOptions: [10, 20, 30, 40],
                sortBy: null,
                sortDesc: false,
                sortDirection: 'asc',
                filter: null
            }
        },
        computed:{
            sortOptions() {
                // Create an options list from our fields
                return this.fields
                .filter(f => f.sortable)
                .map(f => {
                    return { text: f.label, value: f.key }
                })
            }
        },
        methods : {
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            listarAtleta (){
                let me=this;
                var url= '/atletasPendientes';
                axios.get(url).then(function (response) {
                    me.arrayAtleta = response.data.atletas;
                    me.totalRows = me.arrayAtleta.length;
                })
                .catch(function (error) {
                    console.log(error.response.data);
                });
            },
            actualizarAtleta(){
                this.errores =[];

                if (this.validarAtleta()){
                    return;
                }
                
                let me = this;

                axios.post('/atleta/actualizar',{
                    'nombre': this.nombre,
                    'correo': this.correo,
                    'nombre_equipo': this.nombre_equipo,
                    'polera_id': this.polera_id,
                    'id': this.atleta_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAtleta();
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

                    axios.post('/atleta/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarAtleta();
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
            this.listarAtleta();
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
