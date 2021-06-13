<template>
    <div class="container">
           <br>
    <br>
    <h3> Gestion de Aulas </h3>
    <form action="" method="$POST">
        <table>
                <tr>
                    <td>Descripcion</td>
                    <td><input type="text" v-model="descripcion" placeholder="Descripcion"></td>
                    <td>Capacidad</td>
                    <td><input type="text" v-model="capacidad" placeholder="Capacidad"></td>
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
        <input type="text" v-model="buscar" placeholder="Capacidad Minima">
        <input type="text" v-model="buscar2" placeholder="Capacidad Maxima">
        <button type="button" @click="listar(buscar,buscar2)">Buscar por Capacidad</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <th>id</th>
            <th>Descripcion</th>
            <th>Capacidad</th>
        </thead>
        <tbody>
            <tr v-for="aula in arrayAula" :key="aula.id">
                <td v-text="aula.id"></td>
                <td v-text="aula.descripcion"></td>
                <td v-text="aula.capacidad"></td>
                <td><a href="#" @click="llenar(aula)">Seleccionar</a></td>
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
                descripcion: '',
                capacidad: '',
                buscar : '',
                buscar2 : '',
                arrayAula : []
            }
        },
        methods:{
            listar(buscar,buscar2){
                let me = this;
                var url='/aula?buscar='+buscar+'&buscar2='+buscar2;
                axios.get(url).then(function(response){
                    me.arrayAula= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },

            guardar(){
                let me = this;
                axios.post('aula/registrar',{
                    'descripcion': this.descripcion,
                    'capacidad': this.capacidad,
                    
                }).then(function(error){
                    me.listar('','');
                }).catch(function(error){
                    console.log(error);
                });               
            },

            modificar(){
                let me = this;
                axios.put('aula/modificar',{
                    'id': this.id,
                    'descripcion': this.descripcion,
                    'capacidad': this.capacidad,

                }).then(function(error){
                    me.listar('','');
                }).catch(function(error){
                    console.log(error);
                });               
            },


            eliminar(){
                let me = this;
                axios.put('aula/eliminar',{
                    'id': this.id,

                }).then(function(error){
                    me.listar('','');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            llenar(data=[]){
                this.id=data['id'];
                this.descripcion=data['descripcion'];
                this.capacidad=data['capacidad'];
            },
            nuevo(){
                this.descripcion='';
                this.capacidad='';
                this.buscar = '';
                this.buscar2 = '';
            },
        },
        mounted() {
            this.listar('','');
        }
    }
</script>