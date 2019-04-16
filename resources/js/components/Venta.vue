<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Ventas</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Ventas</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
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
                                            :items="arrayVentas"
                                            :fields="fields"
                                            :current-page="currentPage"
                                            :per-page="perPage"
                                            :filter="filter"
                                            :sort-by.sync="sortBy"
                                            :sort-desc.sync="sortDesc"
                                            :sort-direction="sortDirection"
                                            @filtered="onFiltered"
                                            >

                                            <template slot="monto_pago" slot-scope="row">
                                                $ {{ row.item.monto_pago.toLocaleString() }}
                                            </template>


                                            <template slot="estado" slot-scope="row">
                                                <label for="" v-if="row.item.estado == 1"> CONFIRMADO </label>
                                                <label for="" v-else> PENDIENTE</label>
                                            </template>


                                            <template slot="acciones" slot-scope="row">
                                                <template v-if="row.item.estado == 1">
                                                    <b-button size="xs" @click="desactivarVenta(row.item.id)" class="btn btn-danger">
                                                        <i class="icon-trash"></i>
                                                    </b-button>
                                                </template>
                                                <template v-else>
                                                    <b-button size="xs" @click="activarVenta(row.item.id)" class="btn btn-success">
                                                        <i class="icon-check"></i>
                                                    </b-button>
                                                    <b-button size="xs" @click="eliminarAtleta(row.item.id)" class="btn btn-danger">
                                                        <i class="icon-envelope"></i>
                                                    </b-button>
                                                    <b-button size="xs" @click="eliminarVenta(row.item.id)" class="btn btn-danger">
                                                        <i class="icon-close"></i>
                                                    </b-button>
                                                </template>
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
    </div>
</template>

<script>
    import Vue2Filters from 'vue2-filters'
    import BootstrapVue from 'bootstrap-vue'

    Vue.use(BootstrapVue)
    Vue.use(Vue2Filters)

    const items = [
        { isActive: true, age: 40, name: { first: 'Dickerson', last: 'Macdonald' } }
    ]

    export default {
        data (){
            return {
                arrayVentas : [],
                items: items,
                fields: [
                    { key: 'id', label: 'NUM VENTA', sortable: true, sortDirection: 'desc', class: 'text-center' },
                    { key: 'atleta.run', label: 'RUN', sortable: true, class: 'text-left' },
                    { key: 'atleta.nombre', label: 'NOMBRE', sortable: true, class: 'text-left' },
                    { key: 'atleta.correo', label: 'CORREO', sortable: true, class: 'text-left' },
                    { key: 'categoria', label: 'CATEGORÍA', sortable: true, class: 'text-left' },
                    { key: 'monto_pago', label: 'MONTO PAGO', sortable: true, class: 'text-center' },
                    { key: 'estado', label: 'ESTADO', sortable: true, class: 'text-center' },
                    { key: 'acciones', label: 'ACCIONES', sortable: true, class: 'text-center' },
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
            listarVenta (){
                let me=this;
                var url= '/ventas';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayVentas = respuesta.ventas;
                    me.totalRows = me.arrayVentas.length;
                })
                .catch(function (error) {
                    console.log(error.response.data);
                });
            },
            desactivarVenta(id){
                swal({
                    title: '¿Deseas marcar como pendiente de pago?',
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

                            axios.post('/venta/anular',{
                                'id': id
                            }).then(function (response) {
                                me.listarVenta(1,'','nombre');
                                swal(
                                    'Marcada como pendiente de pago!',
                                    'El registro ha sido modificado con éxito.',
                                    'success'
                                )
                            }).catch(function (error) {
                                console.log(error);
                            });
                            
                            
                        } else if (result.dismiss === swal.DismissReason.cancel) {}
                }) 
            },
            activarVenta(id){
                swal({
                title: '¿Deseas confirmar la venta?',
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

                    axios.post('/venta/confirmar',{
                        'id': id
                    }).then(function (response) {
                        me.listarVenta(1,'','nombre');
                        swal(
                            'Se ha confirmado la venta',
                            'El registro ha sido modificado con éxito.',
                            'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            eliminarAtleta(id){
                swal({
                title: '¿Deseas eliminar la venta y el atleta asociado?',
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

                    axios.post('/venta/eliminarAtleta',{
                        'id': id
                    }).then(function (response) {
                        me.listarVenta(1,'','nombre');
                        swal(
                            'Registro eliminado',
                            'El registro ha sido eliminado con éxito.',
                            'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            eliminarVenta(id){
                swal({
                title: '¿Deseas eliminar la venta y el atleta asociado sin notificar?',
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

                    axios.post('/venta/eliminarVenta',{
                        'id': id
                    }).then(function (response) {
                        me.listarVenta(1,'','nombre');
                        swal(
                            'Registro eliminado',
                            'El registro ha sido eliminado con éxito.',
                            'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            }
        },
        mounted() {
            this.listarVenta();
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
