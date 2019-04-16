<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Categorías</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Categorías</li>
                        </ol>
                        <button type="button" @click="abrirModal('categoria','registrar')" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Crear Categoría</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div v-show="estadoCategoria" class="form-group row alert alert-success">
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
                                            :items="arrayCategoria"
                                            :fields="fields"
                                            :current-page="currentPage"
                                            :per-page="perPage"
                                            :filter="filter"
                                            :sort-by.sync="sortBy"
                                            :sort-desc.sync="sortDesc"
                                            :sort-direction="sortDirection"
                                            @filtered="onFiltered"
                                            >
                                            <template slot="valor" slot-scope="row">
                                                $ {{ row.item.valor.toLocaleString() }}
                                            </template>

                                            <template slot="cupos" slot-scope="row">
                                                {{ row.item.cupos / row.item.categoria }}
                                            </template>

                                            <template slot="inscritos" slot-scope="row">
                                                {{ row.item.cantidad_count / row.item.categoria }}
                                            </template>

                                            <template slot="acciones" slot-scope="row">
                                                <b-button size="xs" @click="abrirModal('categoria','actualizar',row.item)" class="btn btn-warning">
                                                    <i class="icon-pencil"></i>
                                                </b-button>

                                                <b-button size="xs" @click="eliminarCategoria(row.item.id)" class="btn btn-danger">
                                                    <i class="icon-trash"></i>
                                                </b-button>
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
                            <div v-show="errorCategoria" class="form-group row alert alert-danger">
                                <div class="text-left">
                                    <li v-for="error in errores" :key="error" v-text="error"></li>
                                </div>
                            </div>
                            <form class="form m-t-20">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" v-model="nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="valor">Valor</label>
                                            <input type="number" class="form-control" v-model="valor">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="cupos">Cupos</label>
                                            <input type="number" class="form-control" v-model="cupos">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="input6">Categoría</label>
                                            <select class="form-control" v-model="categoria">
                                                <option value="1" selected>Individual</option>
                                                <option value="2">Duplas</option>
                                                <option value="3">Tríos</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-group m-b-20">
                                            <label for="nombre">Link de pago</label>
                                            <input type="text" class="form-control" v-model="link_pago">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCategoria()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCategoria()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</template>

<script>
    import Vue2Filters from 'vue2-filters'
    import BootstrapVue from 'bootstrap-vue'

    Vue.use(Vue2Filters)
    Vue.use(BootstrapVue)

    const items = [
        { isActive: true, age: 40, name: { first: 'Dickerson', last: 'Macdonald' } }
    ]

    export default {
        data (){
            return {
                categoria_id: 0,
                nombre : '',
                valor : 0,
                cupos : 0,
                categoria : 0,
                descripcion : '',
                link_pago : '',
                arrayCategoria : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                estadoCategoria: 0,
                estados : [],
                errorCategoria : 0,
                errores : [],
                items: items,
                fields: [
                    { key: 'id', label: 'NUM', sortable: true, sortDirection: 'desc', class: 'text-center' },
                    { key: 'nombre', label: 'NOMBRE', sortable: true, class: 'text-left' },
                    { key: 'nombre_categoria', label: 'CATEGORÍA', sortable: true, class: 'text-left' },
                    { key: 'valor', label: 'VALOR', sortable: true, class: 'text-left' },
                    { key: 'cupos', label: 'CUPOS', sortable: true, class: 'text-left' },
                    { key: 'inscritos', label: 'INSCRITOS', sortable: true, class: 'text-left' },
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
            listarCategoria (){
                let me=this;
                var url= '/categorias';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCategoria = response.data.categorias;
                    me.totalRows = me.arrayCategoria.length;
                })
                .catch(function (error) {
                    console.log(error.response.data);
                });
            },
            registrarCategoria(){
                if (this.validarCategoria()){
                    return;
                }
                
                let me = this;

                axios.post('/categoria/registrar',{
                    'nombre': this.nombre,
                    'valor': this.valor,
                    'cupos': this.cupos,
                    'categoria': this.categoria,
                    'link_pago': this.link_pago
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria();
                    me.statusCategoria(1);
                }).catch(function (error) {
                    console.log(error.response.data);
                });
            },
            actualizarCategoria(){
                this.errores =[];

                if (this.validarCategoria()){
                    return;
                }
                
                let me = this;

                axios.post('/categoria/actualizar',{
                    'nombre': this.nombre,
                    'valor': this.valor,
                    'cupos': this.cupos,
                    'categoria': this.categoria,
                    'link_pago': this.link_pago,
                    'id': this.categoria_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria();
                    me.statusCategoria(2);
                }).catch(function (error) {
                    console.log(error.response.data);
                }); 
            },
            eliminarCategoria(id){
               swal({
                title: '¿Esta seguro de eliminar esta categoría?',
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

                    axios.post('/categoria/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCategoria();
                        swal(
                        'Categoría eliminada!',
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
            validarCategoria(){
                this.errorCategoria=0;
                this.errores =[];

                if (!this.nombre) this.errores.push("El nombre de la categoría no puede estar vacío.");
                if (this.valor < 0) this.errores.push("El valor debe ser mayor o igual a 0.");
                if (this.cupos < 0) this.errores.push("La cantidad de atletas debe ser mayor o igual a 0.");
                if (this.categoria == 0) this.errores.push("Debes seleccionar una categoría.");
                if(!this.link_pago) this.errores.push("Debes ingresar un link de pago.");
                if (this.errores.length) this.errorCategoria = 1;

                return this.errorCategoria;
            },
            statusCategoria(estado){
                this.estadoCategoria = 0;
                this.estados = [];

                if(estado == 1){
                    this.estados.push('Registro agregado exitosamente');
                } else if(estado == 2){
                    this.estados.push('Registro actualizo exitosamente');
                }

                if (this.estados.length) this.estadoCategoria = 1;

                return this.estadoCategoria;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.valor = 0;
                this.cupos = 0;
                this.categoria = 0;
                this.link_pago = '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Categoría';
                                this.nombre = '';
                                this.valor = 0;
                                this.cupos = 0;
                                this.categoria = 0;
                                this.tipoAccion = 1;
                                this.link_pago = '';
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar categoría';
                                this.tipoAccion=2;
                                this.categoria_id=data['id'];
                                this.nombre = data['nombre'];
                                this.valor = data['valor'];
                                this.cupos = data['cupos'];
                                this.categoria = data['categoria'];
                                this.link_pago = data['link_pago'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarCategoria();
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
