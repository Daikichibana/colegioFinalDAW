<template>
    <div class="card">
    <div class="card-body">
        <h1 v-text="'Bienvenido ' + nombre + ' ' + apellido"> </h1>
    </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            nombre : '',
            apellido : '',
        }
    },
    methods:{
        listarEstudiante(buscar){
            let me = this;
            var url='/user/buscarEstudiante?buscar='+ buscar;
            axios.get(url).then(function(response){
                me.nombre = response.data[0].nombre;
                me.apellido = response.data[0].apellido;
            })
            .catch(function(error){
                console.log(error);
            });
        },

        listarDocente(buscar){
            let me = this;
            var url='/user/buscarDocente?buscar='+ buscar;
            axios.get(url).then(function(response){
                me.nombre = response.data[0].nombre;
                me.apellido = response.data[0].apellido;
                console.log(me.nombre );
            })
            .catch(function(error){
                console.log(error);
            });
        },
    },       
    mounted(){
        let usuarioLogeadoId = document.head.querySelector('meta[name="user"]');
        let usuarioLogeadoRol = document.head.querySelector('meta[name="role"]');

        //console.log(usuarioLogeadoId.content + ' ' + usuarioLogeadoRol.content);
        switch(usuarioLogeadoRol.content){
            case "Estudiante": this.listarEstudiante(usuarioLogeadoId.content); break;
            case "Profesor": this.listarDocente(usuarioLogeadoId.content); break;
        } 
    }
}
</script>