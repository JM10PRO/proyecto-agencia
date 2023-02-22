<template>
  <div class="container">
    <div class="card shadow">
      <div class="card-header">Editar poliza</div>
      <div class="card-body">
        <form v-on:submit.prevent="actualizarPoliza" method="post">
          <div class="mb-3" style="text-align: start">
            <label for="importe" class="form-label">Importe:</label>
            <input
              type="number"
              required
              name="importe"
              id="importe"
              v-model="poliza.importe"
              class="form-control"
              placeholder="Escribe el importe de la póliza"
              aria-describedby="helpId"
            />
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
          <div class="btn-group" role="group" aria-label="Button group name">
            <button type="submit" class="btn btn-primary mx-2 rounded shadow-sm">Modificar</button>
            <router-link :to="{ name: 'listarpolizas' }" class="btn btn-warning mx-2 rounded shadow-sm"
              >Cancelar</router-link
            >
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      poliza: {},
    };
  },
  created: function () {
    this.datosPoliza();
  },
  methods: {
    datosPoliza() {
      fetch("http://localhost/agencia-seguros/php/polizas/?consultardatospoliza=" + this.$route.params.id)
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.poliza = datosRespuesta[0];
        })
        .catch(console.log);
    },
    actualizarPoliza() {
      var datosEnviar = {
        importe: this.poliza.importe,
        estado: this.poliza.estado,
        observaciones: this.poliza.observaciones,
      };

      fetch("http://localhost/agencia-seguros/php/polizas/?actualizar=" + this.$route.params.id, {
        method: "POST",
        body: JSON.stringify(datosEnviar),
      })
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.$router.push({ name: 'listarpolizas' });
        });
    },
  },
};
</script>