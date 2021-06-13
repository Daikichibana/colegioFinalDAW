<template>
<center>
    <div class='container'>
    <br>
    <br>
    <h3> Gestion de Estudiantes </h3>
    <form action="" method="$POST">
        <table>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" v-model="nombre" placeholder="Nombre Estudiante"></td>
                </tr>
                <tr>
                    <td>Apellido</td>
                    <td><input type="text" v-model="apellido" placeholder="Apellidos"></td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td><input type="text" v-model="telefono" placeholder="Telefono"></td>
                </tr>
                <tr>
                    <td>Fecha de nacimiento</td>
                    <td><input type="date" v-model="fechaNacimiento" placeholder="fecha de Nacimiento"></td>
                </tr>
                <tr>
                    <td>Direccion</td>
                    <td><input type="text" v-model="direccion" placeholder="Direccion"></td>
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
        <input type="text" v-model="buscar" placeholder="Nombre Estudiante">
        <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <th>id</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Telefono</th>
            <th>Fecha de nacimiento</th>
            <th>Direccion</th>
            <th>Opcion</th>
        </thead>
        <tbody>
            <tr v-for="estudiante in arrayEstudiante" :key="estudiante.id">
                <td v-text="estudiante.id"></td>
                <td v-text="estudiante.nombre"></td>
                <td v-text="estudiante.apellido"></td>
                <td v-text="estudiante.telefono"></td>
                <td v-text="estudiante.fechaNacimiento"></td>
                <td v-text="estudiante.direccion"></td>
                <td><a href="#" @click="llenar(estudiante)">Seleccionar</a></td>
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
            fechaNacimiento: '',
            direccion: '',
            buscar : '',
            arrayEstudiante : []
        }
    },
    methods:{
        listar(buscar){
            let me = this;
            var url='/estudiante?buscar='+buscar;
            axios.get(url).then(function(response){
                me.arrayEstudiante= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },

        guardar(){
            let me = this;
            axios.post('estudiante/registrar',{
                'nombre': this.nombre,
                'apellido' : this.apellido,
                'telefono' : this.telefono,
                'fechaNacimiento': this.fechaNacimiento,
                'direccion' : this.direccion,
                
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },

        modificar(){
            let me = this;
            axios.put('estudiante/modificar',{
                'nombre': this.nombre,
                'apellido' : this.apellido,
                'telefono' : this.telefono,
                'fechaNacimiento': this.fechaNacimiento,
                'direccion' : this.direccion, 
                'id': this.id,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },


        eliminar(){
            let me = this;
            axios.put('estudiante/eliminar',{
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
            this.fechaNacimiento=data['fechaNacimiento'];
            this.direccion=data['direccion'];
        },
        nuevo(){
            this.nombre = '';
            this.apellido = '';
            this.direccion ='';
            this.telefono= '';
            this.buscar = '';
        },
    },       
    mounted(){
        this.listar('');
    }
}
</script>