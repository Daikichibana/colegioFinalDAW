<template>
  <div class="container">
    <template v-if="listado==0">
      <center>
         <h3>Administrar Calificaciones</h3>
         <form action="" method="POST">
        <table>
          <tr>
            <td>Estudiante</td>
            <td>
              <input
                type="hidden"
                v-model="idAEstuCurso"
                placeholder="estudiante..."
              />
              <input
                type="text"
                v-model="estudianteNombre"
                placeholder="estudiante nombre..."
                readonly
              />
              <input
                type="text"
                v-model="estudianteApellido"
                placeholder="estudiante apellido..."
                readonly
              />
            </td>
            <a
              href="#"
              @click="frmBuscarEstudiante()"
              data-toggle="modal"
              data-target="#modalEstudiante"
              >Buscar Estudiante</a
            >
          </tr>
          <tr>
            <td>Gestion</td>
            <input
                type="text"
                v-model="cursoGestion"
                placeholder="gestion..."
                readonly
              />
          </tr>
          <tr>
            <td>Curso</td>
            <td>
              <input type="hidden" v-model="idCurso" />
              <input type="text" v-model="cursoCurso" readonly />
            </td>            
          </tr>
          <tr>
              <td>Materia</td>
            <td>
              <input type="hidden" v-model="idMateria" />
              <input type="text" v-model="materiaNombre" readonly />
            </td>
          </tr>
          <tr>
            <td>Observacion</td>
            <td><input type="text" v-model="observacion" /></td>
          </tr>
          <tr>
            <a
              href="#"
              @click="frmBuscarBimestre()"
              data-toggle="modal"
              data-target="#modalDetalle"
              >Agregar Calificacion</a
            >
          </tr>
          <tr></tr>
        </table>

        <!-- Detalle Calificacion -->
        <table border="1">
          <thead>
            <th>Id</th>
            <th>Nota Ser</th>
            <th>Nota Saber</th>
            <th>Nota Hacer</th>
            <th>Nota Decidir</th>
            <th>Bimestre</th>
          </thead>
          <tbody v-if="arrayDetalle.length">
            <tr v-for="(detalle, index) in arrayDetalle" :key="detalle.id">
              <td><a href="#" @click="eliminarDetalle(index)">Quitar</a></td>
              <td>
                <input
                  type="text"
                  placeholder="Ser..."
                  v-model="detalle.notaSer"
                />
              </td>
              <td>
                <input
                  type="text"
                  placeholder="Saber..."
                  v-model="detalle.notaSaber"
                />
              </td>
                            <td>
                <input
                  type="text"
                  placeholder="Hacer..."
                  v-model="detalle.notaHacer"
                />
              </td>
                      <td>
                <input
                  type="text"
                  placeholder="Decidir..."
                  v-model="detalle.notaDecidir"
                />
              </td>
              <td v-text="detalle.bimestre"></td>

            </tr>
          </tbody>
        </table>


        

        <!-- Botones -->
        <table>
          <tr>
            <td colspan="3">
              <button type="button" @click="nuevo()">Nuevo</button>
              <button type="button" @click="guardarCalificacion()">
                Guardar
              </button>
              <button type="button" @click="modificar()">Modificar</button>
              <button type="button" @click="eliminar()">Eliminar</button>
              <button type="button" @click="buscarCalificacion()">Buscar</button>
            </td>
          </tr>
        </table>
      </form>
      </center>
    </template>
     <!-- menu de buscar Calificacion -->
    <template v-else-if="listado == 1">
      <!-- Buscar Calificaciones -->
      <h3>Busqueda de Calificaciones</h3>
      <input type="text" v-model="buscarCalificacion" placeholder="Nombre Cliente" />
      <button type="button" @click="listar(buscarCalificacion)">Buscar</button>
      <br />
      <a href="#" @click="nuevo()">Volver</a>
      <br />
      <br />
      <table border="1">
        <thead>
          <th>Id</th>
          <th>Gestion</th>
          <th>Estudiante</th>
          <th>Materia</th>
          <th>Bimestre</th>
          <th>Ser</th>
          <th>Saber</th>
          <th>Hacer</th>
          <th>Decidir</th>
          <th>Total</th>
          <th>Opcion</th>
        </thead>
        <tbody>
          <tr v-for="calificacion in arrayCalificacion" :key="calificacion.id">
            <td v-text="calificacion.id"></td>
            <td v-text="calificacion.Gestion"></td>
            <td v-text="calificacion.estudiante + calificacion.estuapell">
            <td v-text="calificacion.Materia"></td>
            <td v-text="calificacion.Bimestre"></td>
            <td v-text="calificacion.Ser"></td>
            <td v-text="calificacion.Saber"></td>
            <td v-text="calificacion.Hacer"></td>
            <td v-text="calificacion.Decidir"></td>
            <td v-text="calificacion.Ser+calificacion.Saber+calificacion.Hacer+calificacion.Decidir"></td>
            <td>
              <a href="#" @click="modificarCalificacion(calificacion.id)"
                >Seleccionar</a
              >
            </td>
          </tr>
        </tbody>
      </table>
    </template>
    <!-- Inicio Modal frmBuscarEstudiante -->
    <div
      class="modal fade"
      id="modalEstudiante"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Busqueda de Estudiante</h4>
            <button type="button" data-dismiss="modal">x</button>
          </div>
          <div class="modal-body">
            <!-- Aqui va su codigo -->
            <form action="" method="$POST">
              <input
                type="text"
                v-model="buscarAEstuCurso"
                placeholder="Nombre Estudiante"
              />
              <button type="button" @click="listarEstudiante(buscarAEstuCurso)">
                Buscar por Nombre
              </button>
            </form>
            <table border="1">
              <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Curso</th>
                <th>Materia</th>
                <th>Gestion</th>
              </thead>
              <tbody>
                <tr v-for="estudiante in arrayAEstuCurso" :key="estudiante.id">
                  <td v-text="estudiante.id"></td>
                  <td v-text="estudiante.nombre"></td>
                  <td v-text="estudiante.apellido"></td>
                  <td v-text="estudiante.curso"></td>
                  <td v-text="estudiante.materia"></td>
                  <td v-text="estudiante.gestion"></td>
                  <td>
                    <a
                      href="#"
                      @click="seleccionarEstudiante(estudiante)"
                      data-dismiss="modal"
                      >Seleccionar</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal frmBuscarEstudiante -->
    <!-- Inicio Modal frmBuscarBimestre -->
    <div
      class="modal fade"
      id="modalDetalle"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Busqueda de Bimestre</h4>
            <button type="button" data-dismiss="modal">x</button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-8">
                <div class="input-group">
                  <input
                    type="text"
                    v-model="buscarBimestre"
                    placeholder="Nombre"
                  />
                  <button
                    type="button"
                    @click="listarBimestre(buscarBimestre)"
                  >
                    Buscar
                  </button>
                  <br />
                  <br />
                  <label for="" v-text="errorMsj"></label>
                  <table border="1">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="bimestre in arrayBimestre"
                        :key="bimestre.id"
                      >
                        <td v-text="bimestre.id"></td>
                        <td v-text="bimestre.bimestre"></td>
                        <td>
                          <a href="#" @click="seleccionarBimestre(bimestre)"
                            >Seleccionar</a
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal">cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal frmBuscarBimestre -->
    
  
  </div>
</template>

 
    




<script>
export default {
  data(){
  return{
    listado: 0,
    estudianteNombre: '',
    estudianteApellido: '',
    idCurso: 0,
    cursoCurso: '',
    cursoGestion: '',
    idMateria:'',
    materiaNombre:'',
    observacion: '',
    detalle: '',
    notaSer:0,
    notaSaber:0,
    notaHacer:0,
    notaDecidir:0,
    buscarAEstuCurso:'',
    arrayDetalle:[],
    arrayCalificacion:[],
    arrayAEstuCurso:[],
    arrayCurso:[],
    arrayBimestre:[],
    arrayMateria:[],
    idBimestre: 0,
    buscarBimestre: '',
    bimestreNombre:'',
    idAEstuCurso:'',
    errorMsj:''
  }
  },
  methods: {
    frmBuscarEstudiante(){
      this.arrayAEstuCurso = [];
      this.buscarAEstuCurso = '';
    },
    frmBuscarBimestre(){
      this.arrayBimestre=[];
      this.buscarBimestre='';
      this.errorMsj='';
    },
    seleccionarEstudiante(data = []){
      this.idAEstuCurso = data["id"];
      this.estudianteNombre = data["nombre"];
      this.estudianteApellido = data["apellido"];
      this.cursoCurso = data["curso"];
      this.materiaNombre = data["materia"];
      this.cursoGestion = data["gestion"];
    },
    listarEstudiante(buscar) {
      let me = this;
      var url = "/calificacion/EstuCurso?buscar=" + buscar;
      axios
        .get(url)
        .then(function (response) {
          me.arrayAEstuCurso = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    eliminarDetalle(index) {
    this.arrayDetalle.splice(index, 1);
    },
    listarBimestre(buscar){
    let me = this;
    var url='/bimestre?buscar='+buscar;
    axios.get(url).then(function(response){
      me.arrayBimestre= response.data;
    })
    .catch(function(error){
      console.log(error);
    });
    },
    seleccionarBimestre(data = []) {
      let me = this;
      if (me.encuentra(data["id"])) {
        this.errorMsj = "Ya se encuentra agregado...";
      } else {
        me.arrayDetalle.push({
          idBimestre: data["id"],
          bimestre: data["bimestre"],
        });
      }
    },
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].idBimestre == id) {
          sw = true;
        }
      }
      return sw;
    },
    guardarCalificacion() {
      let me = this;
      //if(this.validarDatos(this.idEstudiante, this.idCurso, this.fecha, this.arrayDetalle)){
      axios
        .post("/calificacion/registrar", {
          observacion: this.observacion,
          codEstudianteCurso: this.idAEstuCurso, //Asignacion curso Estudiante
          data: this.arrayDetalle,
        })
        .then(function (response) {
          me.respt = "Incripcion Registrada...!";
        })
        .catch(function (error) {
          console.log(error);
        });
        //}

        this.nuevo();
    },
    nuevo(){
    this.listado= 0;
    this.estudianteNombre= '';
    this.estudianteApellido= '';
    this.idCurso= 0;
    this.cursoCurso= '';
    this.cursoGestion= '';
    this.idMateria='';
    this.materiaNombre='';
    this.observacion= '';
    this.detalle= '';
    this.notaSer=0;
    this.notaSaber=0;
    this.notaHacer=0;
    this.notaDecidir=0;
    this.buscarAEstuCurso='';
    this.arrayDetalle=[];
    this.arrayCalificacion=[];
    this.arrayAEstuCurso=[];
    this.arrayCurso=[];
    this.arrayBimestre=[];
    this.arrayMateria=[];
    this.idBimestre= 0;
    this.buscarBimestre= '';
    this.bimestreNombre='';
    this.idAEstuCurso='';
    this.errorMsj='';
    console.log(this.arrayDetalle);
    console.log(this.arrayCalificacion);
    },
    listar(buscar) {
      let me = this;
      this.arrayCalificacion = [];

      var url = "/calificacion/buscarDet?buscar=" + buscar;
      axios
        .get(url)
        .then(function (response) {
          me.arrayCalificacion = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    buscarCalificacion(){
      this.listado=1;
      this.listar('');
    },
    modificarCalificacion(id) {
      let me = this;
      me.listado = 0;
      this.respt = "";
      let arrayCalificacionT;
      var url = "/calificacion/cabecera?id=" + id;
      axios
        .get(url)
        .then(function (response) {
          arrayCalificacionT = response.data.inscripcion;
          me.id = arrayCalificacionT[0].id;
          console.log(arrayCalificacionT);
          me.idEstudiante = arrayCalificacionT[0].idAEstudianteCurso;
          me.estudianteNombre = arrayCalificacionT[0].Estudiante;
          me.estudianteApellido = arrayCalificacionT[0].estuapell;
          me.cursoCurso = arrayCalificacionT[0].curso;
          me.cursoGestion = arrayCalificacionT[0].Gestion;
          me.materiaNombre = arrayCalificacionT[0].Materia;
          me.observacion = arrayCalificacionT[0].observacion;
          console.log(me);
          console.log(typeof arrayCalificacionT);
        })
        .catch(function (error) {
          console.log(error);
        });

      var url1 = "/calificacion/detalle?id=" + id;
      axios
        .get(url1)
        .then(function (response) {
          me.arrayDetalle = response.data.detalle;
        })
        .catch(function (error) {
          console.log(error);
        });
    },


  },
  mounted(){


  }
}
</script>
