<template>
    <div class="container-fluid m-0 p-0">
      <NavBar></NavBar>
      <div class="container-fluid pb-5">
          <div class="card text-start shadow">
              <div class="card-header h4 text-center">Visualización de datos</div>
              <div class="card-body">
                  <div class="row justify-content-evenly">
                      <div class="col col-4 bg-body-secondary p-0 rounded border border-1 border-dark">
                          <div class="alert alert-info h5 shadow">Datos de {{ cliente.nombre }}</div>
                          <div class="px-4">
                              <p>Nombre: {{ cliente.nombre }}</p>
                              <p>Apellidos: {{ cliente.apellidos }}</p>
                              <p>Correo electrónico: {{ cliente.correo }}</p>
                              <p>Teléfono: {{ cliente.telefono }}</p>
                              <p>Localidad: {{ cliente.localidad }}</p>
                              <p>Código postal: {{ cliente.cp }}</p>
                              <p>Provincia: {{ cliente.provincia }}</p>
                              <p>Tipo: {{ cliente.tipo }}</p>
                          </div>
                      </div>
                      <div class="col col-7 bg-body-secondary p-0 rounded border border-1 border-dark">
                          <div class="alert alert-primary h5 shadow">Listado de pólizas</div>
                          <div class="px-4">
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead>
                                          <tr>
                                          <th scope="col">Número de póliza</th>
                                          <th scope="col">Importe</th>
                                          <th scope="col">Fecha</th>
                                          <th scope="col">Estado</th>
                                          <th scope="col">Observaciones</th>
                                          <th scope="col">Acciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr v-for="(poliza, index) in polizas" :key="poliza.numero" :class="[
                                              'alert', 
                                              poliza.estado == 'Cobrada' ? 'alert-success' : '', 
                                              poliza.estado == 'A cuenta' ? 'alert-light' : '', 
                                              poliza.estado == 'Liquidada' ? 'alert-warning' : '',
                                              poliza.estado == 'Anulada' ? 'alert-primary' : '',
                                              poliza.estado == 'Pre-anulada' ? 'alert-dark' : '']">
                                          <td>{{ poliza.numero }}</td>
                                          <td>{{ poliza.importe }}</td>
                                          <td>{{ poliza.fecha }}</td>
                                          <td>{{ poliza.estado }}</td>
                                          <td>{{ poliza.observaciones }}</td>
                                          <td>
                                              <router-link :to="{name:'editarpoliza',params:{numero:poliza.numero,id:cliente.id}}" class="btn btn-primary">Editar</router-link> &nbsp;
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
      cliente: {},
      polizas: [],
    };
  },
  created() {
    this.obtenerInformacionId();
    this.consultarPolizasCliente();
  },
  methods: {
    obtenerInformacionId() {
      fetch(
        "php/clientes/?consultar=" + this.$route.params.id)
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log("datos " + datosRespuesta[0]);
          this.cliente = datosRespuesta[0];
        })
        .catch(console.log);
    },
    consultarPolizasCliente() {
  
    fetch("php/polizas/?consultarpolizascliente=" + this.$route.params.id)
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
            fetch("php/polizas/?borrar="+numero_poliza)
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
  },
};
</script>