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
                {{estudiante}}
                
            </tr>
             <tr>
                <td> MateriaCurso </td>
                <select v-model="curso" placeholder="Curso" >
                <option v-text="cursos.curso_nombre + ' ' + cursos.paralelo_nombre + ' ' + cursos.gestion_nombre" v-for="cursos in arrayCurso" :key="cursos.id" :value="cursos.id">
                    {{cursos.nombre}}
                </option>
                </select>
                {{curso}}
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
          <th>MateriaCurso</th>
        </thead>
        <tbody>
          <tr v-for="asignacion in arrayAsignacion" :key="asignacion.id">
            <td v-text="asignacion.id"></td>
            <td style="display:none;" v-text="asignacion.codEstudiante"></td>
            <td v-text="asignacion.nombreEstudiante"></td>
            <td style="display:none;" v-text="asignacion.codMateriaCurso"></td>
            <td v-text="asignacion.nombreCurso "></td>
            <td v-text="asignacion.cursoMateria"></td>
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
                estudiante: '',
                idEstudiante: 0,
                curso: '',
                idCurso: 0,
                buscar: '',
                buscarEstudiante: '',
                buscarCurso: '',
                arrayAsignacion: [],
                arrayCurso: [],
                arrayEstudiante: []
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
                this.id=data['id'];
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