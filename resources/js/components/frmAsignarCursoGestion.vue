<template>
    <div class="container">
    <br>
    <br>
    <h3>Asignar curso y gestion</h3>
    <form action method="$POST">
        <table>
            <tr>
                <td> Gestion </td>
                <select v-model="gestion" placeholder="Gestion" >
                <option  v-for="gestions in arrayGestion" :key="gestions.id" :value="gestions.id">
                    {{gestions.año}} 
                </option>
                </select>
                {{gestion}}
                <!--v-text="gestions.año"-->
            </tr>
            <tr>
                <td> Curso </td>
                <select v-model="curso" placeholder="Curso" >
                <option v-text="cursos.nombre" v-for="cursos in arrayCurso" :key="cursos.id" :value="cursos.id"></option>
                </select>
            </tr>
            <tr>
                <td> Paralelo </td>
                <select v-model="paralelo" placeholder="Paralelo">
                <option v-text="paralelos.nombre" v-for="paralelos in arrayParalelo" :key="paralelos.id" :value="paralelos.id"></option>
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
          <th>Gestion</th>
          <th>Curso</th>
          <th>Paralelo</th>
        </thead>
        <tbody>
          <tr v-for="asignacion in arrayAsignacion" :key="asignacion.id">
            <td v-text="asignacion.id"></td>
            <td v-text="asignacion.Gestion"></td>
            <td v-text="asignacion.Curso"></td>
            <td v-text="asignacion.Paralelo"></td>
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
                gestion: '',
                idGestion: 0,
                curso: '',
                idCurso: 0,
                paralelo: '',
                idParalelo:0,
                buscar: '',
                buscarGestion: '',
                buscarCurso: '',
                buscarParalelo: '',
                arrayAsignacion: [],
                arrayCurso: [],
                arrayGestion: [],
                arrayParalelo: []
            }
        },
        methods: {
            listar(buscar){
                let me = this;
                var url='/asignacioncursogestion?buscar='+buscar;
                axios.get(url).then(function(response){
                    me.arrayAsignacion= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarCurso(buscarCurso){
                let me = this;
                var url='/curso?buscar='+buscarCurso;
                axios.get(url).then(function(response){
                    me.arrayCurso= response.data;
                })
                .catch(function(error){

                    console.log(error);
                });
            },
            listarGestion(buscarGestion){
                let me = this;
                var url='/gestion2?buscar='+buscarGestion;
                axios.get(url).then(function(response){
                    me.arrayGestion= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarParalelo(buscarParalelo){
                let me = this;
                var url='/paralelo?buscar='+buscarParalelo;
                axios.get(url).then(function(response){
                    me.arrayParalelo= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('asignacioncursogestion/registrar',{
                    'codCurso': this.curso,
                    'codGestion': this.gestion,
                    'codParalelo': this.paralelo,

                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            modificar(){
                let me = this;
                axios.put('asignacioncursogestion/modificar',{
                    'codCurso': this.curso,
                    'codGestion': this.gestion,
                    'codParalelo': this.paralelo,
                    'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            eliminar(){
                let me = this;
                axios.put('asignacioncursogestion/eliminar',{
                  'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            nuevo(){
                this.curso='';
                this.gestion='';
                this.paralelo='';
            },
            llenar(data=[]){
                this.id=data['id'];
                this.gestion=data['codGestion'];
                this.curso=data['codCurso'];
                this.paralelo=data['codParalelo'];
            },
        },
        mounted() {
            this.listar('');
            this.listarCurso('');
            this.listarGestion('');
            this.listarParalelo('');            
        }
    }
</script>