<template>
  <div class="container-fluid m-0 p-0">
    <NavBar></NavBar>
    <div class="container-fluid pb-3">
      <div class="card">
        <div class="card-header bg-primary-subtle d-flex justify-content-between align-middle">
            <p class="h3 pt-2">Listado de pólizas</p>
            <div>
              <router-link :to="{name:'agregarpoliza'}" class="btn btn-success mt-1">Añadir póliza</router-link> 
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
                  <td>{{ poliza.numero }}</td>
                  <td>{{ poliza.importe }}</td>
                  <td>{{ poliza.fecha }}</td>
                  <td>{{ poliza.estado }}</td>
                  <td>{{ poliza.observaciones }}</td>
                  <td>
                      <button class="btn btn-info me-3" @click="verDatosCliente(poliza.cliente_id)">Ver cliente</button>
                      <router-link :to="{name:'editarpoliza',params:{numero:poliza.numero,id:poliza.cliente_id}}" class="btn btn-primary">Editar</router-link> &nbsp;
                      <button type="button" v-on:click="borrarPoliza(index, poliza.numero)" class="btn btn-danger">Borrar</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    
  </template>
  <script>

  import Swal from 'sweetalert2';
  import NavBar from './NavBar.vue';

  export default {
    components:{
      NavBar,
    },
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
      borrarPoliza(index, numero_poliza){
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
            fetch("http://localhost/agencia-seguros/php/polizas/?borrar="+numero_poliza)
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