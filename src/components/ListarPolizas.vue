<template>
    <div class="container">
      <nav>
        <router-link to="/">Home</router-link> |
        <router-link :to="{name:'agregarcliente'}">About</router-link> |
        <router-link :to="{name:'login'}">Login</router-link> |
        <router-link :to="{name:'listarclientes'}">Clientes</router-link> |
        <router-link :to="{name:'listarpolizas'}">Pólizas</router-link>
      </nav>
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
                <tr v-for="(poliza, index) in polizas" :key="poliza.numero" :class="[
                    'alert', 
                    poliza.estado == 'Cobrada' ? 'alert-success' : '', 
                    poliza.estado == 'A cuenta' ? 'alert-info' : '', 
                    poliza.estado == 'Liquidada' ? 'alert-warning' : '',
                    poliza.estado == 'Anulada' ? 'alert-dark' : '',
                    poliza.estado == 'Pre-anulada' ? 'alert-secondary' : '']">
                  <td @click="verDatosCliente(poliza.cliente_id)">{{ poliza.numero }}</td>
                  <td>{{ poliza.importe }}</td>
                  <td>{{ poliza.fecha }}</td>
                  <td>{{ poliza.estado }}</td>
                  <td>{{ poliza.observaciones }}</td>
                  <td>
                      <router-link :to="{name:'editarpoliza',params:{id:poliza.numero}}" class="btn btn-primary">Editar</router-link> &nbsp;
                      <button type="button" v-on:click="borrarPoliza(index, poliza.numero)" class="btn btn-danger">Borrar</button>
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

  import Swal from 'sweetalert2';

  export default {
    data() {
      return {
        polizas: [],
      };
    },
    created: function () {
      this.consultarPolizas();
    },
    methods: {
      consultarPolizas() {
  
        fetch("http://localhost/agencia-seguros/php/polizas/")
          .then((respuesta) => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
  
            if (typeof datosRespuesta[0].success === "undefined") {
              this.polizas = datosRespuesta;
            }
  
          })
          .catch(console.log);
  
      },
      borrarPoliza(index, id){
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success mx-2',
            cancelButton: 'btn btn-danger mx-2'
          },
          buttonsStyling: false
        })
  
        swalWithBootstrapButtons.fire({
          title: '¿Estás seguro de borrar esta póliza?',
          text: "Esta acción no se puede deshacer.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'No, cancelar',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            fetch("http://localhost/agencia-seguros/php/polizas/?borrar="+id)
              .then((respuesta) => respuesta.json())
              .then((datosRespuesta) => {
                console.log(datosRespuesta);
                this.polizas.splice(index, 1);      
              })
              .catch(console.log);
            swalWithBootstrapButtons.fire(
              '¡Eliminado!',
              'La póliza se ha borrado.',
              'success'
            )
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'Se ha conservado la póliza.',
              'error'
            )
          }
        })  
      },
      verDatosCliente(cliente_id){
        this.$router.push({ name: 'visualizardatos', params:{id:cliente_id} });
      }
    },
  };
  </script>