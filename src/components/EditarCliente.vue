<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Editar cliente</div>
      <div class="card-body">
        <form v-on:submit.prevent="actualizarRegistro" method="post">
          <div class="mb-3" style="text-align: start">
            <label for="nombre" class="form-label">Nombre:</label>
            <input
              type="text"
              required
              name="nombre"
              id="nombre"
              v-model="cliente.nombre"
              class="form-control"
              placeholder="Escribe tu nombre"
              aria-describedby="helpId"
            />
            <small id="helpId" class="text-muted"
              >Escribe el nombre del cliente</small
            >
          </div>
          <div class="mb-3" style="text-align: start">
            <label for="correo" class="form-label">Correo:</label>
            <input
              type="email"
              required
              name="correo"
              id="correo"
              v-model="cliente.correo"
              class="form-control"
              placeholder="Escribe tu correo"
              aria-describedby="helpId"
            />
            <small id="helpId" class="text-muted"
              >Escribe el correo del cliente</small
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
      cliente: {},
    };
  },
  created: function () {
    this.obtenerInformacionId();
  },
  methods: {
    obtenerInformacionId() {
      fetch("http://localhost/agencia-seguros/clientes/?consultar=" + this.$route.params.id)
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.cliente = datosRespuesta[0];
        })
        .catch(console.log);
    },
    actualizarRegistro() {
      var datosEnviar = {
        nombre: this.cliente.nombre,
        correo: this.cliente.correo,
      };

      fetch("http://localhost/agencia-seguros/clientes/?actualizar=" + this.$route.params.id, {
        method: "POST",
        body: JSON.stringify(datosEnviar),
      })
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          window.location.href = "../listarclientes";
        });
    },
  },
};
</script>