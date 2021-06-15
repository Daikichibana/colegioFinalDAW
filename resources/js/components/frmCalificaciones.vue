<template>
    <div class="container">
    <br>
    <br>
    <h3>Calificaciones</h3>
    <form>
        <table>
            <tr>
                <td>Observacion</td>
                <td><input type="text" v-model="observacion" placeholder="Observacion"></td>
                </tr>
            <tr>
                <td> Estudiante </td>
                <select v-model="estudiante" placeholder="estudiante" >
                <option  v-for="estudiantes in arrayEstudiante" :key="estudiantes.id" :value="estudiantes.id">
                    {{estudiantes.nombre}} {{estudiantes.apellido}} 
                </option>
                </select>
            </tr>
            <tr>
                <td> Curso </td>
                <select v-model="curso" placeholder="Curso" >
                <option v-text="cursos.nombre" v-for="cursos in arrayCurso" :key="cursos.id" :value="cursos.id"></option>
                </select>
            </tr>
            <tr>
                <td> Materia </td>
                <select v-model="materia" placeholder="materia" >
                <option  v-for="materias in arrayMateria" :key="materias.id" :value="materias.id">
                    {{materias.nombre}} 
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
        <input type="text" v-model="buscar" placeholder="Calificaciones" />
        <button type="button" @click="listar(buscar)">Buscar</button>
        <br>
        <table border="1">
        <thead>
          <th>id</th>
          <th style="display:none;">notaSer</th>
          <th>Ser</th>
          <th style="display:none;">notaSaber</th>
          <th>Saber</th>
          <th style="display:none;">notaHacer</th>
          <th>Hacer</th>
          <th style="display:none;">notaDecidir</th>
          <th>Decidir</th>
          <th style="display:none;">bimestre</th>
          <th>Bimestre</th>
        </thead>
        <tbody>
          <tr v-for="calificacion in arrayCalificacion" :key="calificacion.id">
            <td v-text="calificacion.id"></td>
            <td style="display:none;" v-text="calificacion.notaSer"></td>
            <td v-text="asignacion.notaSer"></td>
            <td style="display:none;" v-text="calificacion.notaSaber"></td>
            <td v-text="asignacion.notaSaber"></td>
            <td style="display:none;" v-text="calificacion.notaHacer"></td>
            <td v-text="asignacion.notaHacer"></td>
            <td style="display:none;" v-text="calificacion.notaDecidir"></td>
            <td v-text="asignacion.notaDecidir"></td>
            <td style="display:none;" v-text="calificacion.codBimestre"></td>
            <td v-text="asignacion.bimestre"></td>
            <td><a href="#" @click="llenar(asignacion)">Seleccionar</a></td>
          </tr>
        </tbody>
        </table>
    </form>
    </div>
</template>

<script>
    export default {
        data () {
            return{
                id:0,
                observacion:'',
                estudiante :'',
                idEstudiante: 0,
                curso :'',
                idCurso: 0,
                materia : '',
                idMateria: 0,
                buscar:'',
                buscarEstudiante:'',
                buscarMateria:'',
                buscarCurso:'',
                arrayCalificacion: [],
                arrayEstudiante:[],
                arrayMateria:[],
                arrayCurso: []

            }
        },
        methods: {
        },
        mounted() {
            this.listarCurso('');
        }
        }
</script>