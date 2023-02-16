<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Editar poliza</div>
      <div class="card-body">
        <form v-on:submit.prevent="actualizarRegistro" method="post">
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
          <div class="btn-group" role="group" aria-label="Button group name">
            <button type="submit" class="btn btn-primary">Modificar</button>
            <router-link :to="{ name: 'listar' }" class="btn btn-warning"
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
    this.obtenerInformacionId();
  },
  methods: {
    obtenerInformacionId() {
      fetch("http://localhost/agencia-seguros/polizas/?consultar=" + this.$route.params.id)
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.poliza = datosRespuesta[0];
        })
        .catch(console.log);
    },
    actualizarRegistro() {
      var datosEnviar = {
        nombre: this.poliza.nombre,
        correo: this.poliza.correo,
      };

      fetch("http://localhost/agencia-seguros/polizas/?actualizar=" + this.$route.params.id, {
        method: "POST",
        body: JSON.stringify(datosEnviar),
      })
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          window.location.href = "../listarpolizas";
        });
    },
  },
};
</script>