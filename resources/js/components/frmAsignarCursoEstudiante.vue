<template>
    <div class="container">
    <br>
    <br>
    <h3>Asignar curso y estudiante</h3>
    <form action method="$POST">
        <table>
            <tr>
                <td> Estudiante </td>
                <select v-model="estudiante" placeholder="Estudiante" >
                <option  v-for="estudiantes in arrayEstudiante" :key="estudiantes.id" :value="estudiantes.id">
                    {{estudiantes.nombre}} 
                </option>
                </select>
                
            </tr>
             <tr>
                <td> MateriaCurso </td>
                <select v-model="curso" placeholder="Curso" >
                <option v-text="cursos.Curso + ' ' + cursos.Paralelo + ' ' + cursos.Gestion" v-for="cursos in arrayCurso" :key="cursos.id" :value="cursos.codMateriaCurso">
                </option>
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
          <th style="display:none;">estudiante</th>
          <th>Nombre estudiante</th>
        <th style="display:none;">MateriaCurso</th>
          <th>Curso</th>
          <th>Materia</th>
          <th>Docente</th>
          <th>Paralelo</th>
          <th>Gestion</th>
        </thead>
        <tbody>
          <tr v-for="asignacionestudiantecurso in arrayAsignacion" :key="asignacionestudiantecurso.id">
            <td v-text="asignacionestudiantecurso.Id"></td>
            <td style="display:none;" v-text="asignacionestudiantecurso.codEstudiante"></td>
            <td v-text="asignacionestudiantecurso.Nombre"></td>
            <td style="display:none;" v-text="asignacionestudiantecurso.codMateriaCurso"></td>
            <td v-text="asignacionestudiantecurso.Curso "></td>
            <td v-text="asignacionestudiantecurso.Materia"></td>
            <td v-text="asignacionestudiantecurso.Docente "></td>
            <td v-text="asignacionestudiantecurso.Paralelo "></td>
            <td v-text="asignacionestudiantecurso.Gestion "></td>
            <td><a href="#" @click="llenar(asignacionestudiantecurso)">Seleccionar</a></td>
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
                estudiante: '',
                idEstudiante: 0,
                curso: '',
                idCurso: 0,
                materia:'',
                idMateria:0,
                docente:'',
                idDocente:0,
                paralelo:'',
                idParalelo:0,
                gestion:'',
                idGestion:0,
                buscar: '',
                buscarEstudiante: '',
                buscarCurso: '',
                buscarMateria: '',
                buscarDocente: '',
                buscarParalelo: '',
                arrayAsignacion: [],
                arrayCurso: [],
                arrayEstudiante: [],
                arrayMateria: [],
                arrayDocente: [],
                arrayParalelo: [],
                arrayGestion: [],
            }
        },
        methods: {
            listar(buscar){
                let me = this;
                var url='/asignacioncursoestudiante?buscar='+buscar;
                axios.get(url).then(function(response){
                    me.arrayAsignacion= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarCurso(buscarCursoMateria){
                let me = this;
                var url='/asignacioncursoestudiante/?buscarcursomateria?buscar='+buscarCursoMateria;
                axios.get(url).then(function(response){
                    me.arrayCurso= response.data;
                })
                .catch(function(error){

                    console.log(error);
                });
            },
            listarEstudiante(buscarEstudiante){
                let me = this;
                var url='/estudiante?buscar='+buscarEstudiante;
                axios.get(url).then(function(response){
                    me.arrayEstudiante= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            
          guardar(){
                let me = this;
                  console.log(this.curso);
                      console.log(this.estudiante);
                axios.post('/asignacioncursoestudiante/registrar',{
                    'codMateriaCurso': this.curso,
                    'codEstudiante': this.estudiante,
                  
                    

                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            modificar(){
                let me = this;
                axios.put('/asignacioncursoestudiante/modificar',{
                    'codMateriaCurso': this.curso,
                    'codEstudiante': this.estudiante, 
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
                axios.put('/asignacioncursoestudiante/eliminar',{
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
                this.estudiante='';
          
            },
            llenar(data=[]){
                this.id=data['Id'];
                this.estudiante=data['codEstudiante'];
                this.curso=data['codMateriaCurso'];
                
            },
        },
        mounted() {
            this.listar('');
            this.listarCurso('');
            this.listarEstudiante('');            
        }
    }
</script>