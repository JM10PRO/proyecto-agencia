<template>
  <div class="container-fluid m-0 p-0">
    <NavBar></NavBar>
    <div class="container pb-3">
      <div class="card">
        <div class="card-header h5">Agregar nueva póliza</div>
        <div class="card-body bg-dark-subtle">
          <form v-on:submit.prevent="agregarPoliza" method="post">
            <div class="mb-3" style="text-align: start">
              <label for="importe" class="form-label">Importe:</label>
              <input
                type="number"
                required
                name="importe"
                id="importe"
                v-model="poliza.importe"
                class="form-control"
                placeholder="Escribe tu importe"
                aria-describedby="helpId"
              />
              <small id="helpId" class="text-muted"
                >Escribe el importe de la poliza</small
              >
            </div>
            <div class="mb-3" style="text-align: start">
              <label for="estado" class="form-label">Estado:</label>
              <select v-model="poliza.estado" name="estado" id="estado" class="form-control">
                <option value="Cobrada">Cobrada</option>
                <option value="A cuenta">A cuenta</option>
                <option value="Liquidada">Liquidada</option>
                <option value="Anulada">Anulada</option>
                <option value="Pre-anulada">Pre-anulada</option>
              </select>
              <small id="helpId" class="text-muted"
                >Indica el estado de la póliza</small
              >
            </div>
            <div class="mb-3" style="text-align: start">
              <label for="observaciones" class="form-label">Observaciones:</label>
              <textarea
                required
                name="observaciones"
                id="observaciones"
                v-model="poliza.observaciones"
                class="form-control"
                placeholder="Escribe los detalles de la póliza"
                aria-describedby="helpId"
                cols="10"
                rows="4"
              ></textarea>
              <small id="helpId" class="text-muted"
                >Introduce las observaciones de la póliza</small
              >
            </div>
            <div class="mb-3" style="text-align: start">
              <label for="clientes" class="form-label">Tomador de la póliza:</label>
              <select v-model="poliza.cliente_id" class="form-select form-select-lg" name="cliente" id="cliente">
                <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">Nombre: {{ cliente.nombre }} {{ cliente.apellidos }} - Correo: {{ cliente.correo }}</option>
              </select>
              <small id="helpId" class="text-muted"
                >Asocia la póliza a un cliente</small
              >
            </div>
            <div class="btn-group" role="group" aria-label="Button group name">
              <button type="submit" class="btn btn-primary mx-2 rounded">Agregar</button>
              <router-link :to="{ name: 'listarpolizas' }" class="btn btn-warning mx-2 rounded"
                >Cancelar</router-link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

import NavBar from './NavBar.vue';

export default {
  components:{
      NavBar,
  },
  data() {
    return {
      poliza: {},
      clientes: {},
    };
  },
  created: function () {
      this.consultarClientes();
  },
  methods: {
    agregarPoliza() {
      console.log(this.poliza);
      var datosEnviar = {
        importe: this.poliza.importe,
        estado: this.poliza.estado,
        observaciones: this.poliza.observaciones,
        cliente_id: this.poliza.cliente_id,
      };

      fetch("http://localhost/agencia-seguros/php/polizas/?insertar=1", {
        method: "POST",
        body: JSON.stringify(datosEnviar),
      })
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.$router.push({ name: 'listarpolizas' });
        });
    },

    consultarClientes() {
  
      fetch("http://localhost/agencia-seguros/php/clientes/")
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);

          if (typeof datosRespuesta[0].success === "undefined") {
            this.clientes = datosRespuesta;
          }

        })
        .catch(console.log);
    },
  },
};
</script>