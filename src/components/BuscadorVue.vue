<template>
    <div class="container-fluid m-0 p-0">
        <NavBar></NavBar>
        <div class="container-fluid pb-3">
            <div class="card mb-3">
                <div class="card-header bg-primary-subtle">
                    <p class="h3 pt-2">Buscador de clientes y pólizas</p>
                </div>
                <div class="card-body text-center">
                    <div class="row justify-content-around mx-5">
                        <div class="col col-7">
                            <div class="row p-2">
                                <div class="col">
                                    <label for="cod1" class="form-label me-2 fw-semibold">Código 1:</label>
                                    <input type="number" name="cod1" id="cod1" class="form-control-md">
                                </div>
                                <div class="col">
                                    <label for="cod2" class="form-label me-2 fw-semibold">Código 2:</label>
                                    <input type="number" name="cod2" id="cod2" class="form-control-md">
                                </div>    
                            </div>
                            <div class="row p-2">
                                <div class="col">
                                    <label for="fecha1" class="form-label me-2 fw-semibold">Fecha 1:</label>
                                    <date-picker v-model="fecha1" valueType="format" name="fecha1" id="fecha1"></date-picker>
                                </div>
                                <div class="col">
                                    <label for="fecha2" class="form-label me-2 fw-semibold">Fecha 2:</label>
                                    <date-picker v-model="fecha2" valueType="format" name="fecha2" id="fecha2"></date-picker>
                                </div>    
                            </div>
                            <div class="row p-2">
                                <div class="col">
                                    <button @click="buscar" type="button" class="btn btn-outline-success">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col col-3 px-5">
                            <label for="estado" class="fw-semibold">Estado de la póliza</label>
                            <select name="estado" id="estado" class="form-select form-select-sm">
                                <option value=""> -- Todos --</option>
                                <option value="Cobrada">Cobrada</option>
                                <option value="A cuenta">A cuenta</option>
                                <option value="Liquidada">Liquidada</option>
                                <option value="Anulada">Anulada</option>
                                <option value="Pre-anulada">Pre-anulada</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="resultado" class="card">
                <div class="card-header bg-success-subtle">
                    <p class="h5 fw-semibold mt-1">Resultados de la búsqueda</p>
                </div>
                <div class="table-responsive bg-primary-subtle">
                    <table class="table table-primary mb-1">
                        <thead>
                            <tr>
                                <th scope="col">Estamos</th>
                                <th scope="col">en</th>
                                <th scope="col">mantenimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td scope="row">R1C1</td>
                                <td>R1C2</td>
                                <td>R1C3</td>
                            </tr>
                            <tr class="">
                                <td scope="row">Item</td>
                                <td>Item</td>
                                <td>Item</td>
                            </tr>
                        </tbody>
                    </table>
                </div>    
            </div>
            
            
        </div>
    </div>
</template>
<script>

import NavBar from './NavBar.vue'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/es';

export default {
    components:{
        NavBar,
        DatePicker,
    },
    data() {
        return {
            cod1: null,
            cod2: null,
            fecha1: null,
            fecha2: null,
            resultado: false
        }
    },
    methods: {
        buscar() {
            this.resultado = true;
            // fetch("http://localhost/agencia-seguros/php/polizas/?consultardatospoliza=" + this.$route.params.numero)
            //     .then((respuesta) => respuesta.json())
            //     .then((datosRespuesta) => {
            //     console.log(datosRespuesta);
            //     this.poliza = datosRespuesta[0];
            //     })
            //     .catch(console.log);
            // },
        },
    
    },
}
</script>