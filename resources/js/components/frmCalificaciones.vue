<template>
  <div class="container">
    <!-- menu registro de Inscripcion -->
   
    <template v-if="listado == 0">
      <center>
      <h3>Administrar Calificaciones</h3>
      <form action="" method="POST">
        <table>
          <tr>
            <td>Estudiante</td>
            <td>
              <input
                type="hidden"
                v-model="idEstudiante"
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
            <td>Curso</td>
            <td>
              <input type="hidden" v-model="idCurso" />
              <input type="text" v-model="cursoCurso" readonly />
              <input type="text" v-model="cursoGestion" readonly />
            </td>
            <a
              href="#"
              @click="frmBuscarCurso()"
              data-toggle="modal"
              data-target="#modalCurso"
              >Buscar Curso</a
            >
            <!--
            <a
              href="#"
              @click="frmVerificarNotas()"
              data-toggle="modal"
              data-target="#modalNotas"
              style="margin-left: 15px"
              >Verificar Notas</a
            >
            -->
          </tr>
          <tr>
              <td>Materia</td>
            <td>
              <input type="hidden" v-model="idMateria" />
              <input type="text" v-model="materiaNombre" readonly />
            </td>
            <a
              href="#"
              @click="frmBuscarMateria()"
              data-toggle="modal"
              data-target="#modalMateria"
              >Buscar Materia</a
            >
          </tr>
          <tr>
            <td>Observacion</td>
            <td><input type="text" v-model="observacion" /></td>
          </tr>
          <tr>
            <a
              href="#"
              @click="frmBuscarDetalle()"
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
                v-model="buscarEstudiante"
                placeholder="Nombre Estudiante"
              />
              <button type="button" @click="listarEstudiante(buscarEstudiante)">
                Buscar por Nombre
              </button>
            </form>
            <table border="1">
              <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
                <th>Telefono</th>
              </thead>
              <tbody>
                <tr v-for="estudiante in arrayEstudiante" :key="estudiante.id">
                  <td v-text="estudiante.id"></td>
                  <td v-text="estudiante.nombre"></td>
                  <td v-text="estudiante.apellido"></td>
                  <td v-text="estudiante.direccion"></td>
                  <td v-text="estudiante.telefono"></td>
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

    <!-- Inicio Modal frmBuscarCurso -->
    <div
      class="modal fade"
      id="modalCurso"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Busqueda de Curso</h4>
            <button type="button" data-dismiss="modal">x</button>
          </div>
          <div class="modal-body">
            <!-- Aqui va su codigo -->
            <center>
              <h3>Busqueda de Cursos</h3>
              <input type="text" v-model="buscarCurso" placeholder="Ej: 1ro" />
              <button type="button" @click="listarCurso(buscarCurso)">
                Buscar por Nombre</button
              ><br />
              <br />
              <br />
              <table border="1">
                <thead>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Gestion</th>
                  <th>Paralelo</th>
                  <th>Opcion</th>
                </thead>
                <tbody>
                  <tr v-for="curso in arrayCurso" :key="curso.id">
                    <td v-text="curso.id"></td>
                    <td v-text="curso.curso_nombre"></td>
                    <td v-text="curso.gestion_nombre"></td>
                    <td v-text="curso.paralelo_nombre"></td>

                    <td>
                      <a href="#" data-dismiss="modal" @click="seleccionarCurso(curso)"
                        >Seleccionar</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </center>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal frmBuscarCurso -->
    <!-- Inicio Modal frmBuscarMateria -->
    <div
      class="modal fade"
      id="modalMateria"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Busqueda de Materia</h4>
            <button type="button" data-dismiss="modal">x</button>
          </div>
          <div class="modal-body">
            <!-- Aqui va su codigo -->
            <center>
              <h3>Busqueda de Materias</h3>
              <input type="text" v-model="buscarMateria" placeholder="Ej: Matematicas" />
              <button type="button" @click="listarMateria(buscarMateria)">
                Buscar por Nombre</button
              ><br />
              <br />
              <br />
              <table border="1">
                <thead>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Opcion</th>
                </thead>
                <tbody>
                  <tr v-for="materia in arrayMateria" :key="materia.id">
                    <td v-text="materia.id"></td>
                    <td v-text="materia.nombre"></td>

                    <td>
                      <a href="#" data-dismiss="modal" @click="seleccionarMateria(materia)"
                        >Seleccionar</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </center>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal frmBuscarMateria -->
    <!-- Inicio Modal frmBuscarDetalle -->
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
            <h4 class="modal-title">Busqueda de Detalle</h4>
            <button type="button" data-dismiss="modal">x</button>
          </div>
          <div class="modal-body">
            <!-- Aqui va su codigo -->
            <center>
              <h3>Busqueda de Detalles</h3>
              <input type="text" v-model="buscarDetalle" placeholder="Ej: Matematicas" />
              <button type="button" @click="listarDetalle(buscarDetalle)">
                Buscar por Nombre</button
              ><br />
              <br />
              <br />
              <table border="1">
                <thead>
                  <th>ID</th>
                  <th>Ser</th>
                  <th>Saber</th>
                  <th>Hacer</th>
                  <th>Decidir</th>
                  <th>Bimestre</th>                  
                  <th>Opcion</th>
                </thead>
                <tbody>
                  <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                    <td v-text="detalle.id"></td>
                    <td v-text="detalle.Ser"></td>
                    <td v-text="detalle.Saber"></td>
                    <td v-text="detalle.Hacer"></td>
                    <td v-text="detalle.Decidir"></td>
                    <td v-text="detalle.Bimestre"></td>

                    <td>
                      <a href="#" data-dismiss="modal" @click="seleccionarDetalle(detalle)"
                        >Seleccionar</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </center>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal frmBuscarMateria -->



   
  </div>
</template>

<script>
 export default {
  data() {
    return {
      id: 0,
      listado: 0,
      buscarCurso: "",
      fecha: "",
      buscarNota: "",
      buscar: "",
      errorMsj: "",
      buscarMateria: "",
      materia: "",
      idMateria: 0,
      materiaNombre: "",
      arrayMateria: [],
      arrayInscripcion: [],
      arrayNotas: [],
      idEstudiante: "",
      estudianteNombre: "",
      estudianteApellido: "",
      estudianteNombre2: "",
      estudianteApellido2: "",
      estudianteDireccion: "",
      estudianteTelefono: "",
      buscarEstudiante: "",
      arrayEstudiante: [],
      notaSer: 0,
      notaSaber: 0,
      notaHacer: 0,
      notaDecidir: 0,
      idCurso: "",
      cursoCurso: "",
      cursoNombre: "",
      cursoParalelo: "",
      cursoGestion: "",
      arrayCurso: [],
      relacion: "",
      arrayDetalle: [],
    };
  },
  methods: {
    frmBuscarEstudiante() {
      this.arrayEstudiante = [];
      this.buscarEstudiante = "";
    },
    frmBuscarCurso() {
      this.arrayCurso = [];
      this.buscarCurso = "";
    },
    frmBuscarMateria() {
      this.arrayMateria = [];
      this.buscarMateria = "";
      this.errorMsj = "";
    },
    seleccionarCurso(data = []) {
      this.idCurso = data["id"];
      this.cursoNombre = data["curso_nombre"];
      this.cursoGestion = data["gestion_nombre"];
      this.cursoParalelo = data["paralelo_nombre"];
      this.cursoCurso = data["curso_nombre"] + " " + data["paralelo_nombre"];
    },
    seleccionarMateria(data = []) {
      this.idMateria = data["id"];
      this.materiaNombre = data["nombre"];
    },
    seleccionarDetalle(data = []) {
      let me = this;
      if (me.encuentra(data["id"])) {
        this.errorMsj = "Ya se encuentra agregado...";
      } else {
        me.arrayDetalle.push({
          id: data["id"],
          notaSer: data["Ser"],
          notaSaber: data["Saber"],
          notaHacer: data["Hacer"],
          notaDecidir: data["Decidir"],
          bimestre: data["Bimestre"],
        });
      }
    },
    seleccionarEstudiante(data = []) {
      this.idEstudiante = data["id"];
      this.estudianteNombre = data["nombre"];
      this.estudianteApellido = data["apellido"];
      this.estudianteDireccion = data["direccion"];
      this.estudianteTelefono = data["telefono"];
    },
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].id == id) {
          sw = true;
        }
      }
      return sw;
    },
    nuevo() {
      this.id = 0;
      this.listado = 0;
      this.estudiante = "";
      this.curso = "";
      this.fecha = "";
      this.buscar = "";
      this.buscarApoderado = "";
      this.apoderado = "";
      this.idApoderado = 0;
      this.apoderadoNombre = "";
      this.apoderadoApellido = "";
      this.apoderadoTelefono = "";
      this.arrayApoderado = [];
      this.arrayInscripcion = [];
      this.arrayNotas = [];
      this.buscarEstudiante = "",
      this.idEstudiante = "",
      this.estudianteNombre = "",
      this.estudianteApellido = "",
      this.estudianteDireccion = "",
      this.estudianteTelefono = "";
      this.arrayEstudiante = [];
      this.relacion = "";
      this.arrayDetalle = [];
      this.idCurso = "";
      this.cursoCurso = "";
      this.cursoGestion = "";
    },
    guardarCalifcacion() {
      let me = this;
      if(this.validarDatos(this.idEstudiante, this.idCurso, this.idMateria, this.observacion)){
      axios
        .post("/calificacion/registrar", {
          fecha: this.fecha,
          idCurso: this.idCurso, //Asignacion curso Gestion
          idEstudiante: this.idEstudiante,
          data: this.arrayDetalle,
        })
        .then(function (response) {
          me.respt = "Calificacion Registrada...!";
        })
        .catch(function (error) {
          console.log(error);
        });
        }

        this.nuevo();
    },

      modificar(){
            let me = this;
            axios.put('inscripcion/eliminarDetalles',{
                id: this.id
            }).then(function(error){
                //
            }).catch(function(error){
                console.log(error);
            }); 

            axios.put('/inscripcion/modificar',{
                fecha: this.fecha,
                idCurso: this.idCurso, //Asignacion curso Gestion
                idEstudiante: this.idEstudiante,
                data: this.arrayDetalle,
                id : this.id,

            }).then(function (response) {
                me.respt = 'inscripcion Modificada...!';
            }).catch(function (error) {
                console.log(error);
            });        
        },


        eliminar(){
            let me = this;

            axios.put('inscripcion/eliminarDetalles',{
                id: this.id
            }).then(function(error){
                //
            }).catch(function(error){
                console.log(error);
            }); 


            axios.put('inscripcion/eliminar',{
              'id': this.id,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },


    buscarInscripcion() {
      this.listado = 1;
      this.listar("");
    },
    listar(buscar) {
      let me = this;
      this.arrayInscripcion = [];

      var url = "/inscripcion?buscar=" + buscar;
      axios
        .get(url)
        .then(function (response) {
          me.arrayInscripcion = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    listarNota(buscarNota, apellido) {
      let me = this;
      var url =
        "/frmbuscarnotas?buscar=" + buscarNota + "&apellido=" + apellido;
      axios
        .get(url)
        .then(function (response) {
          me.arrayNotas = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    listarEstudiante(buscar) {
      let me = this;
      var url = "/estudiante?buscar=" + buscar;
      axios
        .get(url)
        .then(function (response) {
          me.arrayEstudiante = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    listarMateria(buscar) {
      let me = this;
      var url = "/materia?buscar=" + buscar;
      axios
        .get(url)
        .then(function (response) {
          me.arrayMateria = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    listarCurso(buscar) {
      let me = this;
      var url = "/frmbuscarcurso?buscar=" + buscar;
      axios
        .get(url)
        .then(function (response) {
          me.arrayCurso = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    listarInscripcion(buscar) {
      let me = this;
      var url = "/inscripcion?buscar=" + buscar;
      axios
        .get(url)
        .then(function (response) {
          me.arrayInscripcion = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    listarDetalle(buscar) {
      let me = this;
      var url = '/calificacion/buscarDet?buscar=' + buscar;
      axios
        .get(url)
        .then(function (response) {
          me.arrayDetalle = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    modificarDetalle(id) {
      let me = this;
      me.listado = 0;
      this.respt = "";
      let arrayInscripcionT;
      var url = "/inscripcion/obtenerCabecera?id=" + id;
      axios
        .get(url)
        .then(function (response) {
          arrayInscripcionT = response.data.inscripcion;
          me.id = arrayInscripcionT[0].id;
          console.log(arrayInscripcionT);
          me.idEstudiante = arrayInscripcionT[0].idEstudiante;
          me.estudianteNombre = arrayInscripcionT[0].estudianteNombre;
          me.estudianteApellido = arrayInscripcionT[0].estudianteApellido;
          me.idCurso = arrayInscripcionT[0].idCurso;
          me.cursoCurso = arrayInscripcionT[0].cursoNombre + arrayInscripcionT[0].cursoParalelo;
          me.cursoGestion = arrayInscripcionT[0].cursoGestion;
          me.fecha = arrayInscripcionT[0].fecha;
          console.log(me);
          console.log(arrayInscripcionT.idEstudiantes);
          console.log(typeof arrayInscripcionT);
        })
        .catch(function (error) {
          console.log(error);
        });

      var url1 = "/inscripcion/obtenerDetalles?id=" + id;
      axios
        .get(url1)
        .then(function (response) {
          me.arrayDetalle = response.data.detalle;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    eliminarDetalle(index) {
    this.arrayDetalle.splice(index, 1);
  },

  validarDatos(estudiante, curso, materia, observacion) {
    if(estudiante == '' || estudiante == undefined || estudiante == null) {
      alert("debes llenar el campo de estudiante");
      return false;
    } else if(curso == '' || curso == undefined || curso == null) {
      alert("debes llenar el campo de curso");
      return false;
    } else if(materia == '' || materia == undefined || materia == null) {
      alert("debes llenar el campo de materia");
      return false;
    } else if(observacion == '' || observacion == undefined || observacion == null){
      alert("debes llenar el campo de observacion");
      return false;
    }
    return true;
  },
  },
  mounted() {
    console.log("Component mounted.");
    //this.listarApoderado(this.buscar);
  },
};
</script>
