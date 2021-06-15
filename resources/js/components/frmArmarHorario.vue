<template>
    <div class="container">
    <br>
    <br>
    <h3>Armar Horarios</h3>
    <form action method="$POST">
        <table>
            <tr>
                <td> Horarios </td>
                <select v-model="horario" placeholder="Horario" >
                <option v-text="horarios.horaInicio + '-' + horarios.horaFinalizacion + ' ' + horarios.dia" v-for="horarios in arrayhorario" :key="horarios.id" :value="horarios.id"></option>
                </select>
            </tr>
            <tr>
                <td>Aula</td>
                <select v-model="aula" placeholder="aula">
                <option v-text="aulas.descripcion + ' C:' +aulas.capacidad" v-for="aulas in arrayaula" :key="aulas.id" :value="aulas.id"></option>
                </select>
            </tr>
            <tr>
                <td>Materia-Curso</td>
                <select v-model="materiacurso" placeholder="aula">
                <option v-text="materiacursos.Materia+ ' ' +materiacursos.Curso+ ' ' +materiacursos.Paralelo+ ' ' +materiacursos.Docente+ ' ' +materiacursos.Gestion" v-for="materiacursos in arraymateriacurso" :key="materiacursos.id" :value="materiacursos.id"></option>
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
          <th style="display:none;">horario</th>
          <th>Horario Inicio</th>
          <th>Horario Finalizacion</th>
          <th>Dia</th>
          <th>Turno</th>
          <th style="display:none;">aula</th>
          <th>Descripcion del Aula</th>
          <th>Capacidad del Aula</th>
          <th style="display:none;">materiacurso</th>
          <th>Materia</th>
          <th>Docente</th>
          <th>Curso</th>
          <th>Gestion</th>
        </thead>
        <tbody>
          <tr v-for="asignacion in arrayAsignacion" :key="asignacion.id">
            <td v-text="asignacion.Id"></td>
            <td style="display:none;" v-text="asignacion.codHorario"></td>
            <td v-text="asignacion.Ini"></td>
            <td v-text="asignacion.Fin"></td>
            <td v-text="asignacion.Dia"></td>
            <td v-text="asignacion.Turno"></td>
            <td style="display:none;" v-text="asignacion.codAula"></td>
            <td v-text="asignacion.Des"></td>
            <td v-text="asignacion.Cap"></td>
            <td style="display:none;" v-text="asignacion.codMateriacurso"></td>
            <td v-text="asignacion.Materia"></td>
            <td v-text="asignacion.Docente"></td>
            <td v-text="asignacion.Curso + asignacion.Paralelo"></td>
            <td v-text="asignacion.Gestion"></td>
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
                horario: '',
                idhorario: 0,
                materiacurso: '',
                idmateriacurso: 0,
                aula: '',
                idaula:0,
                buscar: '',
                arrayAsignacion: [],
                arraymateriacurso: [],
                arrayhorario: [],
                arrayaula: []
            }
        },
        methods: {
            listar(buscar){
                let me = this;
                var url='/armarhorario?buscar='+buscar;
                axios.get(url).then(function(response){
                    me.arrayAsignacion= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarhorario(buscarhorario){
                let me = this;
                var url='/armarhorario/buscarhorario?buscar='+ buscarhorario;
                axios.get(url).then(function(response){
                    me.arrayhorario= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listaraula(buscaraula){
                let me = this;
                var url='/armarhorario/buscaraula?buscar='+buscaraula;
                axios.get(url).then(function(response){
                    me.arrayaula= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarmateriacurso(buscar){
                let me = this;
                var url='/armarhorario/buscarmateriacurso?buscar='+buscar;
                axios.get(url).then(function(response){
                    me.arraymateriacurso= response.data;
                    console.log(arraymateriacurso)
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('/armarhorario/registrar',{
                    'codMateriacurso': this.materiacurso,
                    'codHorario': this.horario,
                    'codAula': this.aula,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            modificar(){
                let me = this;
                axios.put('/armarhorario/modificar',{
                    'codHorario': this.horario,
                    'codAula': this.aula,
                    'codMateriacurso': this.materiacurso,
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
                axios.put('/armarhorario/eliminar',{
                  'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });   
                 this.nuevo();            
            },
            nuevo(){
                this.materiacurso='';
                this.horario='';
                this.aula='';
            },
            llenar(data=[]){
                this.id=data['Id'];
                this.horario=data['codHorario'];
                this.materiacurso=data['codMateriacurso'];
                this.aula=data['codAula'];
            },
        },
        mounted() {
            this.listar('');
            this.listarmateriacurso('');
            this.listarhorario('');
            this.listaraula('');            
        }
    }
</script>