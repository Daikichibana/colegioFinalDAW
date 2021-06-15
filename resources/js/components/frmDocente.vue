<template>
<center>
    <div class='container'>
    <br>
    <br>
    <h3> Gestion de Docentes </h3>
    <form action="" method="$POST">
        <table>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" v-model="nombre" placeholder="Nombre Estudiante"></td>
                </tr>
                <tr>
                    <td>Apellido</td>
                    <td><input type="text" v-model="apellido" placeholder="Apellido"></td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td><input type="text" v-model="telefono" placeholder="Telefono"></td>
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
        <input type="text" v-model="buscar" placeholder="Nombre Docente">
        <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
    </form>
    <br>
    <table border="2">
        <thead>
            <th>id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Opcion</th>
        </thead>
        <tbody>
            <tr v-for="docente in arrayDocente" :key="docente.id">
                <td v-text="docente.id"></td>
                <td v-text="docente.nombre"></td>
                <td v-text="docente.apellido"></td>
                <td v-text="docente.telefono"></td>
                <td><a href="#" @click="llenar(docente)">Seleccionar</a></td>
            </tr>
        </tbody>
    </table>
    </div>
    </center>


    
</template>

<script>
export default {
    data(){
        return{
            id: 0,
            nombre: '',
            apellido: '',
            telefono: '',
            buscar : '',
            arrayDocente : []
        }
    },
    methods:{
        listar(buscar){
            let me = this;
            var url='/docente?buscar='+buscar;
            axios.get(url).then(function(response){
                me.arrayDocente= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },

        guardar(){
            let me = this;
            axios.post('docente/registrar',{
                'nombre': this.nombre,
                'apellido' : this.apellido,
                'telefono' : this.telefono,
                
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },

        modificar(){
            let me = this;
            axios.put('docente/modificar',{
                'nombre': this.nombre,
                'apellido' : this.apellido,
                'telefono' : this.telefono,
                'id': this.id,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },


        eliminar(){
            let me = this;
            axios.put('docente/eliminar',{
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
            this.apellido=data['apellido'];
            this.telefono=data['telefono'];
        },
        nuevo(){
            this.nombre = '';
            this.apellido = '';
            this.telefono= '';
            this.buscar = '';
        },
    },       
    mounted(){
        this.listar('');
    }
}
</script>