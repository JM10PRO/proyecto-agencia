<template>
    <div class="container">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h2>Listado de polizas</h2>
            <div>
              <router-link :to="{name:'agregarpoliza'}" class="btn btn-success">Añadir póliza</router-link> 
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Número de póliza</th>
                  <th scope="col">Importe</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Observaciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="poliza in polizas" :key="poliza.id" :class="[
                    'alert', 
                    poliza.estado == 'Cobrada' ? 'alert-success' : '', 
                    poliza.estado == 'A cuenta' ? 'alert-info' : '', 
                    poliza.estado == 'Liquidada' ? 'alert-warning' : '',
                    poliza.estado == 'Anulada' ? 'alert-dark' : '',
                    poliza.estado == 'Pre-anulada' ? 'alert-secondary' : '']">
                  <td>{{ poliza.numero }}</td>
                  <td>{{ poliza.importe }}</td>
                  <td>{{ poliza.fecha }}</td>
                  <td>{{ poliza.estado }}</td>
                  <td>{{ poliza.observaciones }}</td>
                  <td>
                      <router-link :to="{name:'editarpoliza',params:{id:poliza.id}}" class="btn btn-primary">Editar</router-link> &nbsp;
                      <button type="button" v-on:click="borrarpoliza(poliza.id)" class="btn btn-danger">Borrar</button>
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
        polizas: [],
      };
    },
    created: function () {
      this.consultarpolizas();
    },
    methods: {
      consultarpolizas() {
  
        fetch("http://localhost/agencia-seguros/polizas/")
          .then((respuesta) => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
            
            this.polizas = [];
  
            if (typeof datosRespuesta[0].success === "undefined") {
              this.polizas = datosRespuesta;
            }
  
          })
          .catch(console.log);
  
      },
      borrarpoliza(id){
  
          console.log(id);
  
          fetch("http://localhost/agencia-seguros/polizas/?borrar="+id)
          .then((respuesta) => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
            
            window.location.href = '/listarpolizas';
  
          })
          .catch(console.log);
  
      }
    },
  };
  </script>