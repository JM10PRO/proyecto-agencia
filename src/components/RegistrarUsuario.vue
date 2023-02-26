<template>
  <div>
    <nav class="d-flex justify-content-between align-items-center bg-secondary bg-gradient p-3 shadow">
        <div class="d-flex justify-content-start">
            <h2 class="text-white">Agencia de seguros</h2>
        </div>
    </nav>
    <div class="container-fluid p-5 d-flex justify-content-center">
      <div class="card w-50">
        <div class="card-header bg-primary bg-gradient text-white h3">Registro</div>
        <div class="card-body bg-primary-subtle">
          <form v-on:submit.prevent="agregarUsuario" method="post">
            <div class="mb-3" style="text-align: start">
              <label for="nombre" class="form-label">Nombre:</label>
              <input
                type="text"
                required
                name="nombre"
                id="nombre"
                v-model="usuario.nombre"
                class="form-control"
                placeholder="Escribe tu nombre"
                aria-describedby="helpId"
              />
            </div>
            <div class="mb-3" style="text-align: start">
              <label for="apellidos" class="form-label">Apellidos:</label>
              <input
                type="text"
                required
                name="apellidos"
                id="apellidos"
                v-model="usuario.apellidos"
                class="form-control"
                placeholder="Escribe tus apellidos"
                aria-describedby="helpId"
              />
            </div>
            <div class="mb-3" style="text-align: start">
              <label for="correo" class="form-label">Correo:</label>
              <input
                type="email"
                required
                name="correo"
                id="correo"
                v-model="usuario.correo"
                class="form-control"
                placeholder="Escribe tu correo"
                aria-describedby="helpId"
              />
            </div>
            <div class="mb-3" style="text-align: start">
              <label for="password" class="form-label">Password:</label>
              <input
                type="password"
                required
                name="password"
                id="password"
                v-model="usuario.passwd"
                class="form-control"
                placeholder="Escribe tu password"
                aria-describedby="helpId"
              />
            </div>
            
            <small class="text-black fw-semibold">¿Ya tienes una cuenta? <a href="/login" class="text-info-emphasis">Iniciar sesión</a> </small> 
            <br>
            
            <div class="btn-group mt-3" role="group" aria-label="Button group name">
              <button type="submit" class="btn btn-primary">Registrarme</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      usuario: {}
    };
  },

  methods: {
    agregarUsuario() {
      console.log(this.usuario);
      var datosEnviar = {
        nombre: this.usuario.nombre,
        apellidos: this.usuario.apellidos,
        correo: this.usuario.correo,
        passwd: this.usuario.passwd
      };

      fetch("http://localhost/agencia-seguros/php/usuarios/?insertar=1", {
        method: "POST",
        body: JSON.stringify(datosEnviar),
      })
      .then((respuesta) => respuesta.json())
      .then((datosRespuesta) => {
        console.log(datosRespuesta);
        this.$router.push({ name: 'login' });
      });
    },
  },
};
</script>
<style scoped>
div.container-fluid{
    background-image: url('../assets/img/fondo.jpg');
    background-size: cover;
    background-position: center;
  }
</style>