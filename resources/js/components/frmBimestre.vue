<template>
    <div class="container">
    <br>
    <br>
    <h3>Gestion Bimestres</h3>
    <form action="" method="$POST">
        <table>
            <tr>
                <td> Bimestre </td>
                <td><input type = "text" v-model="bimestre" placeholder="Nombre Bimestre"></td>
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
        <input type="text" v-model="buscar" placeholder="Nombre Bimestre">
        <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <th>id</th>
            <th>Bimestre</th>
            <th>Opcion</th>
        </thead>
        <tbody>
            <tr v-for="bimestre in arrayBimestre" :key="bimestre.id">
                <td v-text="bimestre.id"></td>
                <td v-text="bimestre.bimestre"></td>
                <td><a href="#" @click="llenar(bimestre)">Seleccionar</a></td>
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
                bimestre:'',
                buscar: '',
                arrayBimestre: []
            }
        },
        methods:{
            listar(buscar){
                let me = this;
                var url='/bimestre?buscar='+buscar;
                axios.get(url).then(function(response){
                    me.arrayBimestre= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('bimestre/registrar',{
                    'bimestre': this.bimestre,

                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            modificar(){
                let me = this;
                axios.put('bimestre/modificar',{
                    'bimestre': this.bimestre,
                    'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            eliminar(){
                let me = this;
                axios.put('bimestre/eliminar',{
                  'id': this.id,
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            llenar(data=[]){
                this.id=data['id'];
                this.bimestre=data['bimestre'];
            },
            nuevo(){
                this.bimestre = '';
                this.buscar = '';
            },
        },
        mounted() {
            this.listar('');
        }
    }
</script>