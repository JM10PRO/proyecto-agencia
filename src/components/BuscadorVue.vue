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
                                    <input type="text" name="fecha1" id="fecha1">
                                </div>
                                <div class="col">
                                    <label for="fecha2" class="form-label me-2 fw-semibold">Fecha 2:</label>
                                    <input type="date" name="fecha2" id="fecha2" class="form-control-md">
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
            <div class="table-responsive rounded-3">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">Column 1</th>
                            <th scope="col">Column 2</th>
                            <th scope="col">Column 3</th>
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
</template>
<script>

import NavBar from './NavBar.vue'

export default {
    created() {
        this.datePicker();
    },
    components:{
        NavBar,
    },
    methods: {
      
    },
}
</script>