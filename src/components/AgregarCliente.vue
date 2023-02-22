<template>
  <div class="container">
    <div class="card">
      <div class="card-header h4">Agregar nuevo cliente</div>
      <div class="card-body bg-dark-subtle">
        <form v-on:submit.prevent="agregarCliente" method="post">
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
            <small id="helpId" class="text-muted"
              >Escribe el nombre del cliente</small
            >
          </div>
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
            <small id="helpId" class="text-muted"
              >Escribe los apellidos del cliente</small
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
            <small id="helpId" class="text-muted"
              >Escribe el teléfono del cliente</small
            >
          </div>
          <div class="mb-3" style="text-align: start">
            <label for="" class="form-label">Provincia:</label>
            <select v-model="cliente.provincia" @change="provIsSelected=true, obtenerMunicipios(cliente.provincia), provinciaSeleccionada(cliente.provincia)" class="form-select form-select-lg" name="provincia" id="provincia">
              <option v-for="provincia in provincias" :key="provincia.nombre" :value="provincia.cod">{{ provincia.nombre }}</option>
            </select>
          </div>
          <div v-if="provIsSelected" class="mb-3" style="text-align: start">
            <label for="" class="form-label">Municipio:</label>
            <select v-model="cliente.municipio" @change="municipioSeleccionado(cliente.municipio)" class="form-select form-select-lg" name="municipio" id="municipio">
              <option v-for="municipio in municipios" :key="municipio.municipio" :value="municipio.id">{{ municipio.municipio }}</option>
            </select>
          </div>
          <div class="mb-3" style="text-align: start">
            <label for="cp" class="form-label">Código postal:</label>
            <input
              type="number"
              required
              name="cp"
              id="cp"
              v-model="cliente.cp"
              class="form-control"
              placeholder="Escribe el código postal del municipio"
              aria-describedby="helpId"
            />
            <small id="helpId" class="text-muted"
              >Escribe el código postal del cliente</small
            >
          </div>
          <div class="mb-3" style="text-align: start">
            <label for="tipo" class="form-label">Tipo:</label>
            <select v-model="cliente.tipo" name="tipo" id="tipo" class="form-select form-select-lg">
              <option value="empresa">Empresa</option>
              <option value="particular">Particular</option>
            </select>
            <small id="helpId" class="text-muted"
              >Indica si eres una empresa o un particular</small
            >
          </div>

          <div class="btn-group" role="group" aria-label="Button group name">
            <button type="submit" class="btn btn-primary mx-2 rounded">Agregar</button>
            <router-link :to="{ name: 'listarclientes' }" class="btn btn-warning mx-2 rounded"
              >Cancelar</router-link>
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
      provincias: [],
      municipios: [],
      codProvinciaSelected: "",
      nombreProvincia: "",
      nombreMunicipio: "",
      provIsSelected: false,
    };
  },
  created: function () {
    this.obtenerProvincias();
  },
  methods: {
    agregarCliente() {
      console.log(this.cliente);
      var datosEnviar = {
        nombre: this.cliente.nombre,
        apellidos: this.cliente.apellidos,
        correo: this.cliente.correo,
        telefono: this.cliente.telefono,
        provincia: this.nombreProvincia,
        municipio: this.nombreMunicipio,
        cp: this.cliente.cp,
        tipo: this.cliente.tipo,
      };

      fetch("http://localhost/agencia-seguros/php/clientes/?insertar=1", {
        method: "POST",
        body: JSON.stringify(datosEnviar),
      })
      .then((respuesta) => respuesta.json())
      .then((datosRespuesta) => {
        console.log(datosRespuesta);
        this.$router.push({ name: 'listarclientes' });
      });
    },
    obtenerProvincias() {

    fetch("http://localhost/agencia-seguros/php/clientes/?provincias=1")
    .then((respuesta) => respuesta.json())
      .then((datosRespuesta) => {
        
        console.log(datosRespuesta);
        this.provincias = [];

          if (typeof datosRespuesta[0].success === "undefined") {
            this.provincias = datosRespuesta;
          }

      })
      .catch(console.log);
    },

    obtenerMunicipios(codProv) {

      fetch("http://localhost/agencia-seguros/php/clientes/?municipios="+codProv)
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          
          console.log(datosRespuesta);

            if (typeof datosRespuesta[0].success === "undefined") {
              this.municipios = datosRespuesta;
            }

        })
        .catch(console.log);
    },
    provinciaSeleccionada(cod){
      this.codProvinciaSelected = cod;
      fetch("http://localhost/agencia-seguros/php/clientes/?provinciaId=" + cod)
      .then((respuesta) => respuesta.json())
      .then((datosRespuesta) => {
        
        console.log('datos respuesta prov '+datosRespuesta);

          if (typeof datosRespuesta[0].success === "undefined") {
            this.nombreProvincia = datosRespuesta[0].nombre;
          }

      })
      .catch(console.log);
    },
    municipioSeleccionado(cod){
      this.codProvinciaSelected = cod;
      fetch("http://localhost/agencia-seguros/php/clientes/?municipioId=" + cod)
      .then((respuesta) => respuesta.json())
      .then((datosRespuesta) => {
        
        console.log('datos respuesta prov '+datosRespuesta);

          if (typeof datosRespuesta[0].success === "undefined") {
            this.nombreMunicipio = datosRespuesta[0].municipio;
          }

      })
      .catch(console.log);
    }
  },
};
</script>