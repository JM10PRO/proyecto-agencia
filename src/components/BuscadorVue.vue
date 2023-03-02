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
                                    <label for="cod1" class="form-label me-2 fw-semibold">Desde cliente:</label>
                                    <input v-model="cod1" type="number" name="cod1" id="cod1" class="form-control-md">
                                </div>
                                <div class="col">
                                    <label for="cod2" class="form-label me-2 fw-semibold">Hasta cliente:</label>
                                    <input v-model="cod2" type="number" name="cod2" id="cod2" class="form-control-md">
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
                                    <div v-if="mensaje" class="mb-3">
                                        <span class="h6 p-1 bg-danger text-white fw-semibold rounded">Por favor, rellena todos los campos</span>
                                    </div>
                                    <button @click="buscar" type="button" class="btn btn-outline-success">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col col-3 px-5">
                            <label for="estado" class="fw-semibold">Estado de la póliza</label>
                            <select v-model="estado" name="estado" id="estado" class="form-select form-select-sm">
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
            <div v-if="noresultado" class="mb-3">
                <span class="h6 p-1 bg-danger text-white fw-semibold rounded">No hay datos que coincidan con la búsqueda.</span>
            </div>
            <div v-if="resultado" class="card">
                <div class="card-header bg-success-subtle">
                    <p class="h5 fw-semibold mt-1">Resultados de la búsqueda</p>
                </div>
                <div class="table-responsive">
                    <table class="table mb-1">
                        <thead>
                            <tr>
                                <th scope="col ms-3">Cliente</th>
                                <th scope="col ms-3">Número de póliza</th>
                                <th scope="col ms-3">Importe</th>
                                <th scope="col ms-3">Fecha</th>
                                <th scope="col ms-3">Estado</th>
                                <th scope="col ms-3">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="(poliza) in listado" :key="poliza.numero" :class="[
                    'alert', 
                    poliza.estado == 'Cobrada' ? 'alert-danger' : '', 
                    poliza.estado == 'A cuenta' ? 'alert-danger' : '', 
                    poliza.estado == 'Liquidada' ? 'alert-warning' : '',
                    poliza.estado == 'Anulada' ? 'alert-danger' : '',
                    poliza.estado == 'Pre-anulada' ? 'alert-danger' : '']">
                                    <td>{{ poliza.cliente_id }}</td>
                                    <td>{{ poliza.numero }}</td>
                                    <td>{{ poliza.importe }}</td>
                                    <td>{{ poliza.fecha }}</td>
                                    <td>{{ poliza.estado }}</td>
                                    <td>{{ poliza.observaciones }}</td>
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
            estado: null,
            resultado: false,
            noresultado: false,
            mensaje: false,
            listado: {}
        }
    },
    methods: {
        buscar() {
            var datosEnviar = {
                cod1: this.cod1,
                cod2: this.cod2,
                fecha1: this.fecha1,
                fecha2: this.fecha2,
                estado: this.estado,
            };

            if(this.cod1 == null || this.cod2 == null || this.fecha1 == null || this.fecha2 == null){
                this.mensaje = true;
            }else {
                fetch("php/polizas/?buscar=1", {
                method: "POST",
                body: JSON.stringify(datosEnviar),
                })
                .then((respuesta) => respuesta.json())
                .then((datosRespuesta) => {
                    if(datosRespuesta == "noresultado"){
                        this.listado = 0;
                        this.noresultado = true;
                        this.resultado = false;
                        this.mensaje = false;
                    }else{
                        this.listado = datosRespuesta;
                        this.mensaje = false;
                        this.resultado = true;
                        this.noresultado = false;
                    }
                    console.log(datosRespuesta);
                })
                .catch(console.log);
            }
        },
    },
}
</script>