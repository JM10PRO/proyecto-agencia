<template>
  <div class="login">
    <div class="row d-flex justify-content-center">
      <div class="card bg-success bg-gradient text-start" style="width: 33%">
        <h2 class="card-title text-center text-white m-3">Login</h2>
        <div class="card-body text-center">
          <form action class="form" @submit.prevent="login">
            <label class="form-label bg-dark-subtle p-1 rounded-start border border-secondary" for="email"><img src="../assets/user.svg" alt="Correo" style="width: 36px;"></label>
            <input
              v-model="email"
              class="form-input p-2 rounded-end"
              type="email"
              id="email"
              required
              placeholder="Email"
            />
            <br><br>
            <label class="form-label bg-dark-subtle p-1 rounded-start border border-secondary" for="password"><img src="../assets/password.svg" alt="Clave" style="width: 36px;"></label>
            <input
              v-model="password"
              class="form-input p-2 rounded-end"
              type="password"
              id="password"
              placeholder="Password"
            />
            <br>
            <p v-if="error" class="error">
              Has introducido mal el email o la contraseña.
            </p>
            <br>
            <small class="text-white">¿Aún no tienes una cuenta? <a href="/registrarse" class="text-warning">Registrarse</a> </small>
            <br><br>
            <input class="form-submit btn btn-primary shadow" type="submit" value="Sign in" />
          </form>
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

      fetch("http://localhost/agencia-seguros/usuarios/")
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);

          this.usuarios = [];

          if (typeof datosRespuesta[0].success === "undefined") {
            this.usuarios = datosRespuesta;
          }

          this.usuarios.forEach((usuario) => {
            if (this.email == usuario.correo && this.password == usuario.passwd) {
              window.location.href = "/listarclientes";
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