<template>
    <div class="container">
       <h1>Consultar Calificaciones</h1>
       <form action="" method="$POST">
        <table>     
                <tr>
                    <td colspan="3">
                        <br>
                        <br>
                        <input type="text" v-model="buscar" placeholder="Año">
                        <button type="button" @click="listar(buscar)">Buscar por Año</button>
                    </td>
                </tr>
        </table>
        <br>
        <br>
    </form>
    <table border="1">
        <thead>
            <th>Materia</th>
            <th>Observacion</th>
            <th>Gestion</th>
            <th>Ser</th>
            <th>Saber</th>
            <th>Hacer</th>
            <th>Decidir</th>
            <th>Bimestre</th>
        </thead>
        <tbody>
            <tr v-for="detallecalificacion in arrayBusqueda" :key="detallecalificacion.id">
                <td v-text="detallecalificacion.Materia"></td>
                <td v-text="detallecalificacion.Obs"></td>
                <td v-text="detallecalificacion.Gestion"></td>
                <td v-text="detallecalificacion.Ser"></td>
                <td v-text="detallecalificacion.Saber"></td>
                <td v-text="detallecalificacion.Hacer"></td>
                <td v-text="detallecalificacion.Decidir"></td>
                <td v-text="detallecalificacion.Bimestre"></td>
            </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                id: 0,
                año: '',
                buscar : '',
                arrayBusqueda : []
            }
        },
        methods:{
            listar(buscar){
                let me = this;
                var url='/consultarCali?buscar='+buscar+'&buscar2='+me.id;
                axios.get(url).then(function(response){
                    me.arrayBusqueda = response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },

            listarEstudiante(buscar){
            let me = this;
            var url='/buscarIdEstudiante?buscar='+ buscar;
            axios.get(url).then(function(response){
                me.id = response.data[0].id;
            })
            .catch(function(error){
                console.log(error);
            });
            },

        },
        mounted() {
            let usuarioLogeadoId = document.head.querySelector('meta[name="user"]');
            let usuarioLogeadoRol = document.head.querySelector('meta[name="role"]');

            switch(usuarioLogeadoRol.content){
            case "Estudiante": this.listarEstudiante(usuarioLogeadoId.content); break;
            }
        }
    }
</script>