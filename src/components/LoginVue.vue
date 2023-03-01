<template>
  <div>
    <nav class="d-flex justify-content-between align-items-center bg-secondary bg-gradient p-3 shadow">
        <div class="d-flex justify-content-start">
            <h2 class="text-white">Agencia de seguros</h2>
        </div>
    </nav>
    <div class="container-fluid p-5">
      <div class="row d-flex justify-content-center">
        <div class="card bg-success bg-gradient text-start" style="width: 33%">
          <h2 class="card-title text-center text-white m-3">Login</h2>
          <div class="card-body text-center">
            <form action class="form" @submit.prevent="login">
              <label class="form-label bg-dark-subtle p-1 rounded-start border border-secondary" for="email"><img src="../assets/icons/user.svg" alt="Correo" style="width: 36px;"></label>
              <input
                v-model="email"
                class="form-input p-2 rounded-end"
                type="email"
                id="email"
                required
                placeholder="Email"
              />
              <br><br>
              <label class="form-label bg-dark-subtle p-1 rounded-start border border-secondary" for="password"><img src="../assets/icons/password.svg" alt="Clave" style="width: 36px;"></label>
              <input
                v-model="password"
                class="form-input p-2 rounded-end"
                type="password"
                id="password"
                required
                placeholder="Password"
              />
              <br>
              <span v-if="error" class="error p-1 fw-semibold bg-light rounded">
                No se reconoce el email o la contraseña.
              </span>
              <br>
              <small class="text-white">¿Aún no tienes una cuenta? <router-link :to="{name:'registrarse'}" class="text-warning">Registrarse</router-link> </small>
              <br><br>
              <input class="form-submit btn btn-primary shadow" type="submit" value="Iniciar sesión" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
export default {
  data: () => ({
    email: "",
    password: "",
    error: false,
  }),
  methods: {
    login() {
      console.log(this.email);
      console.log(this.password);

      fetch("php/usuarios/")
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);

          this.usuarios = [];

          if (typeof datosRespuesta[0].success === "undefined") {
            this.usuarios = datosRespuesta;
          }

          this.usuarios.forEach((usuario) => {
            if (this.email == usuario.correo && this.password == usuario.passwd) {
              this.$router.push({ name: 'listarclientes' });
              this.error = false;
            } else {
              this.error = true;
            }
          });
        })
        .catch(console.log);
    },
  },
};
</script>

<style scoped>
  .error {
    color: #c60808;
    font-size: small;
  }
</style>