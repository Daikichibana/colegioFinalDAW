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
                <!--v-text="gestions.año"-->
            </tr>
            <tr>
                <td> MateriaCurso </td>
                <select v-model="materiacurso" placeholder="Curso" >
                <option v-text="materiacursos.nombre" v-for="materiacursos in arrayMateriaCurso" :key="materiacursos.id" :value="materiacursos.id"></option>
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
          <th>Estudiante</th>
          <th>MateriaCurso</th>
        </thead>
        <tbody>
          <tr v-for="asignacion in arrayAsignacion" :key="asignacion.id">
            <td v-text="asignacion.id"></td>
            <td v-text="asignacion.codEstudiante"></td>
            <td v-text="asignacion.codMateriaCurso"></td>
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
                materiacurso: '',
                idMateriaCurso: 0,
                buscar: '',
                buscarEstudiante: '',
                buscarMateriaCurso: '',
                arrayAsignacion: [],
                arrayMateriaCurso: [],
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
            listarMateriaCurso(buscarMateriaCurso){
                let me = this;
                var url='/materiacurso?buscar='+buscarMateriaCurso;
                axios.get(url).then(function(response){
                    me.arrayMateriaCurso= response.data;
                })
                .catch(function(error){

                    console.log(error);
                });
            },
            listarEstudiante(buscarEstudiante){
                let me = this;
                var url='/estudiante2?buscar='+buscarEstudiante;
                axios.get(url).then(function(response){
                    me.arrayEstudiante= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('asignacioncursoestudiante/registrar',{
                    'codMateriaCurso': this.materiacurso,
                    'codEstudiante': this.estudiante,

                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            modificar(){
                let me = this;
                axios.put('asignacioncursoestudiante/modificar',{
                    'codMateriaCurso': this.materiacurso,
                    'codEstudiante': this.estudiante,
                    'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            eliminar(){
                let me = this;
                axios.put('asignacioncursoestudiante/eliminar',{
                  'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            nuevo(){
                this.materiacurso='';
                this.estudiante='';
            },
            llenar(data=[]){
                this.id=data['id'];
                this.estudiante=data['codEstudiante'];
                this.materiacurso=data['codMateriaCurso'];
            },
        },
        mounted() {
            this.listar('');
            this.listarMateriaCurso('');
            this.listarEstudiante('');           
        }
    }
</script>