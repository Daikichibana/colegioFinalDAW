<template>
    <div class="container">
    <br>
    <br>
    <h3>Gestion Paralelos</h3>
    <form action="" method="$POST">
        <table>
            <tr>
                <td> Nombre </td>
                <td><input type = "text" v-model="nombre" placeholder="Nombre Paralelo"></td>
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
        <br>
        <br>
        <input type="text" v-model="buscar" placeholder="Nombre Paralelo">
        <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <th>id</th>
            <th>Nombre</th>
            <th>Opcion</th>
        </thead>
        <tbody>
            <tr v-for="paralelo in arrayParalelo" :key="paralelo.id">
                <td v-text="paralelo.id"></td>
                <td v-text="paralelo.nombre"></td>
                <td><a href="#" @click="llenar(paralelo)">Seleccionar</a></td>
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
                nombre:'',
                buscar: '',
                arrayParalelo: []
            }
        },
        methods:{
            listar(buscar){
                let me = this;
                var url='/paralelo?buscar='+buscar;
                axios.get(url).then(function(response){
                    me.arrayParalelo= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('paralelo/registrar',{
                    'nombre': this.nombre,

                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            modificar(){
                let me = this;
                axios.put('paralelo/modificar',{
                    'nombre': this.nombre,
                    'id': this.id,

                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            eliminar(){
                let me = this;
                axios.put('paralelo/eliminar',{
                  'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            llenar(data=[]){
                this.id=data['id'];
                this.nombre=data['nombre'];
            },
            nuevo(){
                this.nombre = '';
                this.buscar = '';
            },
        },
        mounted() {
            this.listar('');
        }
    }
</script>