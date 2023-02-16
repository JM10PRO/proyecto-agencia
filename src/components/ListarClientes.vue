<template>
    <div class="container">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h2>Listado de clientes</h2>
            <div>
                <a href="/agregar-cliente" class="btn btn-success">Dar de alta</a>  
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="tablaclientes" class="table table-striped table-ligh">
              <thead>
                <tr>
                  <!-- <th scope="col">ID</th> -->
                  <th scope="col">Nombre</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Localidad</th>
                  <th scope="col">CP</th>
                  <th scope="col">Provincia</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr class="" v-for="cliente in clientes" :key="cliente.id">
                  <!-- <td>{{ cliente.id }}</td> -->
                  <td>{{ cliente.nombre }}</td>
                  <td>{{ cliente.correo }}</td>
                  <td>{{ cliente.telefono }}</td>
                  <td>{{ cliente.localidad }}</td>
                  <td>{{ cliente.cp }}</td>
                  <td>{{ cliente.provincia }}</td>
                  <td>{{ cliente.tipo }}</td>
                  <td>
                      <router-link :to="{name:'editarcliente',params:{id:cliente.id}}" class="btn btn-primary">Modificar</router-link> &nbsp;
                      <button type="button" v-on:click="borrarCliente(cliente.id)" class="btn btn-danger">Baja</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-muted">Fin de la sección</div>
      </div>
    </div>
  </template>
  <script>
  export default {
    data() {
      return {
        clientes: [],
      };
    },
    created: function () {
      this.consultarClientes();
    },
    methods: {
      consultarClientes() {
  
        fetch("http://localhost/agencia-seguros/clientes/")
          .then((respuesta) => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
            
            this.clientes = [];
  
            if (typeof datosRespuesta[0].success === "undefined") {
              this.clientes = datosRespuesta;
            }
  
          })
          .catch(console.log);
  
      },
      borrarCliente(id){
  
          console.log(id);
  
          fetch("http://localhost/agencia-seguros/clientes/?borrar="+id)
          .then((respuesta) => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
            
            window.location.href = '/listarclientes';
  
          })
          .catch(console.log);
  
      }
    },
  };
  </script>