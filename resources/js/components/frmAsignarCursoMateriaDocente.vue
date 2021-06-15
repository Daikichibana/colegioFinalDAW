<template>
    <div class="container">
    <br>
    <br>
    <h3>Asignar curso, Materia y Docente</h3>
    <form action method="$POST">
        <table>
            <tr>
                <td> Materia </td>
                <select v-model="materia" placeholder="materia" >
                <option  v-for="materias in arraymateria" :key="materias.id" :value="materias.id">
                    {{materias.nombre}} 
                </option>
                </select>
                <!-- {{materia}} -->
                <!--v-text="materias.año"-->
            </tr>
            <tr>
                <td> Curso </td>
                <select v-model="curso" placeholder="Curso" >
                <option v-text="cursos.curso_nombre + ' ' + cursos.paralelo_nombre + ' ' + cursos.gestion_nombre" v-for="cursos in arrayCurso" :key="cursos.id" :value="cursos.id"></option>
                </select>
            </tr>
            <tr>
                <td> Docente </td>
                <select v-model="docente" placeholder="docente">
                <option v-text="docentes.nombre + ' ' +docentes.apellido" v-for="docentes in arraydocente" :key="docentes.id" :value="docentes.id"></option>
                </select>
            </tr>
            <tr>
                <td colspan="3">
                    <br>
                    <br>
                    <button type="button" @click="nuevo()">Nuevo</button>
                    <button type="button" @click="guardar()">Guardar</button>
                    <button type="button" @click="modificar()">Modificar</button>
                    <button type="button" @click="eliminar()">Eliminar</button>
                </td>
            </tr>
        </table>
        <br />
        <br />
        <input type="text" v-model="buscar" placeholder="Asignacion" />
        <button type="button" @click="listar(buscar)">
        Buscar
        </button>
        <br>
        <table border="1">
        <thead>
          <th>Id</th>
          <th style="display:none;">materia</th>
          <th>Nombre materia</th>
          <th style="display:none;">curso</th>
          <th>Nombre Curso</th>
          <th>Gestion</th>
          <th style="display:none;">docente</th>
          <th>Nombre docente</th>
        </thead>
        <tbody>
          <tr v-for="asignacion in arrayAsignacion" :key="asignacion.id">
            <td v-text="asignacion.id"></td>
            <td style="display:none;" v-text="asignacion.codMateria"></td>
            <td v-text="asignacion.nombreMateria"></td>
            <td style="display:none;" v-text="asignacion.codCursoGestion"></td>
            <td v-text="asignacion.nombreCurso + asignacion.nombreParalelo"></td>
            <td v-text="asignacion.gestionCurso"></td>
            <td style="display:none;" v-text="asignacion.codDocente"></td>
            <td v-text="asignacion.nombreDocente + ' ' + asignacion.apellidoDocente"></td>
            <td><a href="#" @click="llenar(asignacion)">Seleccionar</a></td>
          </tr>
        </tbody>
      </table>
    </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                hola: {},
                id: 0,
                materia: '',
                idmateria: 0,
                curso: '',
                idCurso: 0,
                docente: '',
                iddocente:0,
                buscar: '',
                buscarmateria: '',
                buscarCurso: '',
                buscardocente: '',
                arrayAsignacion: [],
                arrayCurso: [],
                arraymateria: [],
                arraydocente: []
            }
        },
        methods: {
            listar(buscar){
                let me = this;
                var url='/asignacioncursomateria?buscar='+buscar;
                axios.get(url).then(function(response){
                    me.arrayAsignacion= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarCurso(buscarCursoGestion){
                let me = this;
                var url='/asignacioncursomateria/buscarcursogestion?buscar=' + buscarCursoGestion;
                axios.get(url).then(function(response){
                    me.arrayCurso= response.data;
                })
                .catch(function(error){

                    console.log(error);
                });
            },
            listarmateria(buscarmateria){
                let me = this;
                var url='/asignacioncursomateria/buscarmateria?buscar='+ buscarmateria;
                axios.get(url).then(function(response){
                    me.arraymateria= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listardocente(buscardocente){
                let me = this;
                var url='/asignacioncursomateria/buscardocente?buscar='+buscardocente;
                axios.get(url).then(function(response){
                    me.arraydocente= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('/asignacioncursomateria/registrar',{
                    'codCursoGestion': this.curso,
                    'codMateria': this.materia,
                    'codDocente': this.docente,

                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            modificar(){
                let me = this;
                axios.put('/asignacioncursomateria/modificar',{
                    'codCursoGestion': this.curso,
                    'codMateria': this.materia,
                    'codDocente': this.docente,
                    'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });      
                this.nuevo();         
            },
            eliminar(){
                let me = this;
                axios.put('/asignacioncursomateria/eliminar',{
                  'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });   
                 this.nuevo();            
            },
            nuevo(){
                this.curso='';
                this.materia='';
                this.docente='';
            },
            llenar(data=[]){
                this.id=data['id'];
                this.materia=data['codMateria'];
                this.curso=data['codCursoGestion'];
                this.docente=data['codDocente'];
            },
        },
        mounted() {
            this.listar('');
            this.listarCurso('');
            this.listarmateria('');
            this.listardocente('');            
        }
    }
</script>