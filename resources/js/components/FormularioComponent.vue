<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <p class="text-justify lead h3 mt-5 p-3">
          Sistemas y Equipos de Computación
          <br />PBX: 2924030 • e-mail:syscompsa@gye.satnet.net
          <br />Cdla. Vernaza Norte - Mz.25 V-16 • Guayaquil - Ecuador
        </p>
      </div>
      <div class="col-md-4">
        <img
          id="report_logo"
          src="../../assets/Syscompsa_Nuevo.png"
          class="img-fluid p-3 rounded mx-auto"
          alt="Responsive Logo"
        />
      </div>
      <div class="col-3">
        <p class="text-justify lead h3 p-3 font-weight-bold">REPORTE DE SERVICIO</p>
      </div>
      <div class="col-3">
        <p class="text-right ml-6 lead h3 p-3 font-weight-bold">00000000</p>
      </div>
      <div class="ml-5 col-5">
        <p class="text-right ml-6 lead h3 p-3 font-weight-bold">Fecha de emisión: {{reporte.fecha}}</p>
      </div>
      </div>
      <form @submit.prevent="agregar">
        <div class="form-row">
          <div class="form-group col-md-8">
            <label class="control-label font-weight-bold h5">Cliente</label>
            <multiselect v-model="reporte.cliente" track-by="codigo" :options="clientes" label="empcli" placeholder="Select Client..."></multiselect>
          </div>
          <div class="form-group col-md-4">
            <label class="col-md-4 control-label font-weight-bold h5">Fecha</label>
            <input
              id="fecha"
              name="fecha"
              placeholder="Fecha"
              class="form-control"
              v-model="reporte.fechaReporte"
              value
              type="date"
            />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label class="control-label font-weight-bold h5">Solicitado Por</label>
            <input
                id="solicitadoPor"
                name="solicitadoPor"
                placeholder="Solicitado Por"
                class="form-control"
                v-model="reporte.solicitadoPor"
                value
                type="text"
            />
          </div>
          <div class="form-group col-md-4">
            <label class="control-label font-weight-bold h5">Orden Trabajo</label>
            <input
              id="ordenTrabajo"
              name="ordenTrabajo"
              placeholder="Orden de Trabajo"
              class="form-control"
              v-model="reporte.ordenTrabajo"
              value
              type="text"
            />
          </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-12">
          <label class="control-label font-weight-bold h5">Detalle</label>
          <button
            type="button"
            class="btn btn-primary offset-1"
            data-toggle="modal"
            data-target="#exampleModal"
            data-whatever="@getbootstrap"
          >Agregar Detalle</button>
        </div>
        </div>
        <div class="form-row">
        <div id="gridDetales" class="form-group col-md-12">
          <b-list-group>
            <b-list-group-item v-for="(detalle,index) in reporte.listaDetalles" :key="index">
              <b-container>
                <b-row>
                  <b-col cols="3">Rubro: {{detalle.rubro.nombre}}</b-col>
                  <b-col>Descripcion: {{detalle.descripcion}}</b-col>
                  <b-col cols="2">Tiempo: {{detalle.tiempo}}</b-col>
                  <b-col cols="2">
                    <b-button-group>
                      <b-button @click="editarDetalle(detalle)" variant="warning">
                        <b-icon icon="pencil"></b-icon>Edit
                      </b-button>
                      <b-button @click="eliminarDetalle(detalle,index)"  variant="danger">
                        <b-icon icon="trash">X</b-icon>Delete
                      </b-button>
                    </b-button-group>
                  </b-col>
                </b-row>
              </b-container>
            </b-list-group-item>
          </b-list-group>
        </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label class="control-label font-weight-bold h5">Solucion</label>
            <input
              id="solucion"
              name="solucion"
              placeholder="Solucion"
              class="form-control"
              v-model="reporte.solucion"
              value
              type="text"
            />
          </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-8">
          <div class="form-check form-check-inline">
            <label class="control-label mr-4">Facturar</label>
            <input
              id="facturar"
              name="state"
              class="form-check-input mr-4"
              v-model="reporte.facturar"
              value
              type="checkbox"
              
            />

            <label class="control-label mr-4">Solucionado</label>
            <input
              id="solucionado"
              name="state"
              class="form-check-input mr-4"
              v-model="reporte.solucionado"
              value
              type="checkbox"
            />

            <label class="control-label mr-4">Contrato</label>
            <input
              id="contrato"
              name="state"
              class="form-check mr-4"
              v-model="reporte.contrato"
              value
              type="checkbox"
            />
          </div>
        </div>
          <div class="form-group col-md-4">
            <label class="control-label font-weight-bold h5 mr-4">Departamento</label>
            <input
              id="departamento"
              name="dpto"
              class="form-control"
              v-model="reporte.departamento"
              value
              type="text"
            />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4 offset-1">
            <label class="control-label font-weight-bold h5">Hora Inicial</label>
            <input
              id="hora_inicial"
              name="hora_inicial"
              placeholder="Hora inicial"
              class="form-control"
              v-model="reporte.horaInicial"
              value
              type="time"
            />
          </div>
          <div class="form-group col-md-4 offset-1">
            <label  class="control-label font-weight-bold h5">Hora Final</label>
            <p
              id="hora_final"
              name="hora_final"
              class="form-control font-weight-bold h6"
              type="time"> {{sumarHoras()}}
            </p>
          </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-12">
          <label class="control-label font-weight-bold h5">Observaciones</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        </div>
        <div>
          <button class="btn btn-primary" type="submit">Guardar</button>
        </div>
      </form>

      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
        data-backdrop="static"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Agregar Detalle</h5>
              <button @click="cerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form @submit="agregarDetalle">
                <div class="form-group">
                  <label for="rubroInput" class="col-form-label">Rubro</label>
                  <multiselect v-model="reporteDetalle.rubro" :options="rubros" label="nombre" placeholder="Select..." :disabled="editarActivado"></multiselect>
                </div>
                <div class="form-group">
                  <label for="descripcionInput" class="col-form-label">Descripcion</label>
                  <textarea v-model="reporteDetalle.descripcion" class="form-control" id="descripcionInput"></textarea>
                </div>
                <div class="form-group">
                  <label for="tiempo-total" class="col-form-label">Tiempo total</label>
                  <input v-model="reporteDetalle.tiempo" type="time" class="form-control" id="tiempo-total" placeholder="00:00" />
                </div>
                <button
                  id="saveButton"
                  data-dismiss="modal"
                  type="submit"
                  class="btn btn-primary"
                  @click="agregarDetalle"
                >Agregar detalle</button>
              </form>

            </div>
            <div class="modal-footer">
              <button @click="cerrarModal" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect';
import moment from 'moment';
import Swal from 'sweetalert2';
export default {
  data() {
    return {
      clientes: [],
      rubros: [],
      cliente: null,
      reporte: {
        tipo: "",
        cliente: "",
        nroReporte: "",
        cod_asesor: "",
        fecha: moment().format('YYYY/MM/DD'),
        fechaReporte: "",
        solicitadoPor: "",
        solucion: "",
        facturar: false,
        solucionado: false,
        contrato: false,
        departamento: "",
        horaInicial: "00:00",
        horaFinal: "",
        observaciones: "",
        ordenTrabajo: "",
        listaDetalles:[]
      },
      reporteDetalle: { tipo: "", rubro: null, descripcion: "", tiempo:"00:00"},
      editarActivado: false
    };
  },
  computed:{
    /*sumarHoras(){
      let horafinal = moment(this.reporte.horaInicial,"HH:mm") ;
      for(let i = 0; i<this.reporte.listaDetalles.length; i++){
        let duracion = moment(this.reporte.listaDetalles[i].tiempo,"HH:mm");
        horafinal.add({'hours':duracion.hours(),'minutes':duracion.minutes()},"HH:mm");
      }
      this.reporte.horaFinal=horafinal.format("HH:mm");
      console.log(this.reporte.horaFinal);
      return this.reporte.horaFinal;
    }*/
  },
  methods: {
    sumarHoras(){
      let horafinal = moment(this.reporte.horaInicial,"HH:mm") ;
      for(let i = 0; i<this.reporte.listaDetalles.length; i++){
        let duracion = moment(this.reporte.listaDetalles[i].tiempo,"HH:mm");
        horafinal.add({'hours':duracion.hours(),'minutes':duracion.minutes()},"HH:mm");
      }
      this.reporte.horaFinal=horafinal.format("HH:mm");
      console.log(this.reporte.horaFinal);
      return this.reporte.horaFinal;
    },
    agregar() {
      axios.post("/reporte",this.reporte)
        .then(res=>{
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'El reporte ha sido guardado!',
            footer: 'Continua!'
          })
        }).catch(res=>{
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No ha sido posible guardar el reporte!',
            footer: 'Prueba a reintentar enviar'
          })
        })
    },
    eliminar() {},
    agregarClientes(){
      axios.get("/clientes").then(res=>{
        for(var i = 0; i < res.data.length; i++){
          this.clientes.push(res.data[i]);
        }
      });
    },
    cargarRubros(){
      axios.get("/rubros").then(res=>{
        for(var i = 0; i < res.data.length; i++){
          this.rubros.push(res.data[i]);
        }
      })
    },
    agregarDetalle(){
      if(this.editarActivado){
        this.guardarDetalle();
      }else if(this.reporte.listaDetalles.findIndex(item => item.rubro === this.reporteDetalle.rubro) !== -1){
        alert("No es posible tener rubros repetidos en la lista");
      }else{
      const newClient={
        tipo: this.reporteDetalle.tipo,
        rubro: this.reporteDetalle.rubro,
        descripcion: this.reporteDetalle.descripcion,
        tiempo: this.reporteDetalle.tiempo
      }
      this.reporteDetalle.rubro = "";
      this.reporteDetalle.descripcion = "";
      this.reporteDetalle.tiempo = "";
      this.reporte.listaDetalles.push(newClient);
      }
    },
    guardarDetalle(){
      const updateDetail ={
        rubro: this.reporteDetalle.rubro,
        descripcion: this.reporteDetalle.descripcion,
        tiempo: this.reporteDetalle.tiempo
      }
      this.reporteDetalle.rubro = "";
      this.reporteDetalle.descripcion = "";
      this.reporteDetalle.tiempo = "";
      const index = this.reporte.listaDetalles.findIndex(item => item.rubro === updateDetail.rubro);
      this.reporte.listaDetalles[index] = updateDetail;
      this.editarActivado = false;
    },
    cerrarModal(){
      this.editarActivado=false;
      this.reporteDetalle.rubro = "";
      this.reporteDetalle.descripcion = "";
      this.reporteDetalle.tiempo = "";
    },
    editarDetalle(detalle){
      this.editarActivado = true;
      this.reporteDetalle.rubro = detalle.rubro;
      this.reporteDetalle.descripcion = detalle.descripcion;
      this.reporteDetalle.tiempo = detalle.tiempo;
      $('#exampleModal').modal('show');
    },
    eliminarDetalle(item, index){
      this.reporte.listaDetalles.splice(index,1);
    }
  },
  created(){
    this.agregarClientes();
    this.cargarRubros();
  },
  beforeMount(){
    
  },
  mounted(){

  },
  components: { Multiselect }
};
</script>

<style>
#report_logo{
    width: 50%;
    height: 100%;
}
input[type=checkbox]{
  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 10px;
}
</style>