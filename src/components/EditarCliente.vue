<template>
  <div class="container">
    <div class="card shadow">
      <div class="card-header">Editar cliente</div>
      <div class="card-body">
        <form v-on:submit.prevent="actualizarCliente" method="post">
          <div class="row">
            <div class="col">
              <div class="mb-3" style="text-align: start">
                  <label for="nombre" class="form-label">Nombre:</label>
                  <input
                    type="text"
                    required
                    name="nombre"
                    id="nombre"
                    v-model="cliente.nombre"
                    class="form-control"
                    placeholder="Escribe el nombre"
                    aria-describedby="helpId"
                  />
                  <small id="helpId" class="text-muted ms-1"
                    >Escribe el nombre del cliente</small
                  >
                </div>
              </div>
              <div class="col">
                <div class="mb-3" style="text-align: start">
                  <label for="apellidos" class="form-label">Apellidos:</label>
                  <input
                    type="text"
                    required
                    name="apellidos"
                    id="apellidos"
                    v-model="cliente.apellidos"
                    class="form-control"
                    placeholder="Escribe los apellidos"
                    aria-describedby="helpId"
                  />
                  <small id="helpId" class="text-muted ms-1"
                    >Escribe los apellidos del cliente</small
                  >
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col">
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
              <small id="helpId" class="text-muted ms-1"
                >Escribe el correo del cliente</small
              >
            </div>
              </div>
              <div class="col">
                <div class="mb-3" style="text-align: start">
              <label for="telefono" class="form-label">Teléfono:</label>
              <input
                type="number"
                required
                name="telefono"
                id="telefono"
                v-model="cliente.telefono"
                class="form-control"
                placeholder="959848767"
                aria-describedby="helpId"
              />
              <small id="helpId" class="text-muted ms-1"
                >Escribe el teléfono del cliente</small
              >
            </div>
              </div>
          <div class="mb-3" style="text-align: start">
            <label for="tipo" class="form-label">Tipo:</label>
            <select v-model="cliente.tipo" name="tipo" id="tipo" class="form-select form-select-lg">
              <option value="empresa">Empresa</option>
              <option value="particular">Particular</option>
            </select>
            <small id="helpId" class="text-muted ms-1"
              >Indica si eres una empresa o un particular</small
            >
          </div>
          </div>
          <div class="btn-group" role="group" aria-label="Button group name">
            <button type="submit" class="btn btn-primary mx-1 rounded">Modificar</button>
            <router-link :to="{ name: 'listarclientes' }" class="btn btn-warning mx-1 rounded"
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
      fetch("clientes/?consultar=" + this.$route.params.id)
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.cliente = datosRespuesta[0];
        })
        .catch(console.log);
    },
    actualizarCliente() {
      var datosEnviar = {
        nombre: this.cliente.nombre,
        apellidos: this.cliente.apellidos,
        correo: this.cliente.correo,
        telefono: this.cliente.telefono,
        cp: this.cliente.cp,
        tipo: this.cliente.tipo,
      };

      fetch("clientes/?actualizar=" + this.$route.params.id, {
        method: "POST",
        body: JSON.stringify(datosEnviar),
      })
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.$router.push({ name: 'listarclientes'});
        });
    },
  },
};
</script>