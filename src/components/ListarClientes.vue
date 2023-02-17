<template>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header bg-primary-subtle d-flex justify-content-between align-middle">
            <p class="h3 pt-2">Listado de clientes</p>
            <div>
                <a href="/agregar-cliente" class="btn btn-success mt-1">Dar de alta</a>  
            </div>
        </div>
        <div class="card-body bg-body-tertiary text-start">
          <div class="table-responsive px-5">
            <table id="tablaclientes" class="table table-striped table-light">
              <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Localidad</th>
                  <th scope="col">C. Postal</th>
                  <th scope="col">Provincia</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(cliente, index) in clientes" :key="cliente.id">
                  <td>{{ cliente.nombre }}</td>
                  <td>{{ cliente.apellidos }}</td>
                  <td>{{ cliente.correo }}</td>
                  <td>{{ cliente.telefono }}</td>
                  <td>{{ cliente.localidad }}</td>
                  <td>{{ cliente.cp }}</td>
                  <td>{{ cliente.provincia }}</td>
                  <td>{{ cliente.tipo }}</td>
                  <td>
                      <router-link :to="{name:'visualizardatos',params:{id:cliente.id}}" ><abbr class="abbr-detalles"><img src="../assets/icons/icono-detalles.svg" class="icon" alt="Detalles"></abbr></router-link> &nbsp;
                      <router-link :to="{name:'editarcliente',params:{id:cliente.id}}"><abbr class="abbr-modificar"><img src="../assets/icons/icono-modificar.svg" class="icon" alt="Modificar"></abbr></router-link> &nbsp;
                      <button type="button" v-on:click="borrarCliente(index, cliente.id, cliente.nombre, cliente.apellidos)" class="btn btn-link p-0"><abbr class="abbr-eliminar"><img src="../assets/icons/icono-eliminar.svg" class="icon" alt="Eliminar"></abbr></button>
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

  import "jquery/dist/jquery.min.js";
  import "datatables.net-dt/js/dataTables.dataTables";
  import "datatables.net-dt/css/jquery.dataTables.min.css";
  import $ from "jquery";
  import Swal from 'sweetalert2';
  
  export default {
    mounted(){
      this.consultarClientes();
    },
    data() {
      return {
        clientes: [],
      };
    },
    methods: {
      tabla(){
        this.$nextTick(() => {
          $("#tablaclientes").DataTable();
        });      
      },
      consultarClientes() {
  
        fetch("http://localhost/agencia-seguros/clientes/")
          .then((respuesta) => respuesta.json())
          .then((datosRespuesta) => {
            console.log(datosRespuesta);
  
            if (typeof datosRespuesta[0].success === "undefined") {
              this.clientes = datosRespuesta;
              this.tabla();
              console.log("tabla creada");
            }
          })
          .catch(console.log);
  
      },
      borrarCliente(index, id, nombre, apellidos){
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success mx-2',
            cancelButton: 'btn btn-danger mx-2'
          },
          buttonsStyling: false
        })
  
        swalWithBootstrapButtons.fire({
          title: `¿Estás seguro de borrar a ${nombre} ${apellidos}?`,
          text: "Esta acción no se puede deshacer.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'No, cancelar',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
              fetch("http://localhost/agencia-seguros/clientes/?borrar="+id)
              .then((respuesta) => respuesta.json())
              .then((datosRespuesta) => {
                console.log(datosRespuesta);
                this.clientes.splice(index, 1);     
              })
              .catch(console.log);
            swalWithBootstrapButtons.fire(
              '¡Eliminado!',
              'El registro se ha borrado.',
              'success'
            )
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'Se ha conservado el registro.',
              'error'
            )
          }
        })
      }
    },
  };
  </script>