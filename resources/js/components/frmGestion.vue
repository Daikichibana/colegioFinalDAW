<template>
    <div class="container">
    <br>
    <br>
    <h3> Administrar Gestion Escolar </h3>
    <form action="" method="$POST">
        <table>
                <tr>
                    <td>Año</td>
                    <td><input type="text" v-model="año" placeholder="Año"></td>
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
        <input type="text" v-model="buscar" placeholder="Año Inicio">
        <input type="text" v-model="buscar2" placeholder="Año Final">
        <button type="button" @click="listar(buscar, buscar2)">Buscar por Año</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <th>id</th>
            <th>Año</th>
        </thead>
        <tbody>
            <tr v-for="gestion in arrayGestion" :key="gestion.id">
                <td v-text="gestion.id"></td>
                <td v-text="gestion.año"></td>
                <td><a href="#" @click="llenar(gestion)">Seleccionar</a></td>
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
                buscar2 : '',
                arrayGestion : []
            }
        },
        methods:{
            listar(buscar, buscar2){
                let me = this;
                var url='/gestion?buscar='+buscar+'&buscar2='+buscar2;
                axios.get(url).then(function(response){
                    me.arrayGestion= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },

            guardar(){
                let me = this;
                axios.post('gestion/registrar',{
                    'año': this.año,
                    
                }).then(function(error){
                    me.listar('','');
                }).catch(function(error){
                    console.log(error);
                });               
            },

            modificar(){
                let me = this;
                axios.put('gestion/modificar',{
                    'id': this.id,
                    'año': this.año,

                }).then(function(error){
                    me.listar('','');
                }).catch(function(error){
                    console.log(error);
                });               
            },


            eliminar(){
                let me = this;
                axios.put('gestion/eliminar',{
                    'id': this.id,

                }).then(function(error){
                    me.listar('','');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            llenar(data=[]){
                this.id=data['id'];
                this.año=data['año'];
            },
            nuevo(){
                this.año = '';
                this.buscar = '';
                this.buscar2 = '';
            },
        },
        mounted() {
            this.listar('','');
        }
    }
</script>