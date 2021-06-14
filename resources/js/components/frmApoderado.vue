<template>
<center>
<div class="container">
   
 <h3>Apoderado</h3>
   <form action="" method="$POST">
 <table>
     <tr>
         <td>Nombre</td>
         <td><input type="text" v-model="nombre" placeholder="Nombre"></td>
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
         <td>Direccion</td>
         <td><input type="text" v-model="direccion" placeholder="Direccion"></td>
     </tr>
         <tr>
         <td>FechaNacimiento</td>
         <td><input type="date" v-model="fechaNacimiento" placeholder="FechaNacimiento"></td>
     </tr>
     <tr>
         <td colspan="3">
            <button type="button" @click="nuevo()">Nuevo</button>
            <button type="button" @click="guardar()">Guardar</button>
            <button type="button" @click="modificar()">Modificar</button>
            <button type="button" @click="eliminar()">Eliminar</button>
           
         </td>
     </tr>
 </table>
 <input type="text" v-model="buscar" placeholder="Nombre">
 <button type="button" @click="listar(buscar)"> Buscar </button>
 </form>
 <br>
 <br>
 <table border="3">
     <thead>
         <th>Id</th>
         <th>Nombre</th>
         <th>Apellido</th>
         <th>Telefono</th>
         <th>Direccion</th>
         <th>FechaNacimiento</th>
         <th>Opcion</th>
     </thead>
     <tbody>
     <tr v-for="apoderado in arrayApoderado" :key="apoderado.id">
         <td v-text="apoderado.id"></td>
         <td v-text="apoderado.nombre"></td>
         <td v-text="apoderado.apellido"></td>
         <td v-text="apoderado.telefono"></td>
         <td v-text="apoderado.direccion"></td>
         <td v-text="apoderado.fechaNacimiento"></td>
         <td><a href="#" @click="llenar(apoderado)">Seleccionar</a></td>
        <!-- <td v-text="apoderado.relacion"></td>-->
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
                id:0,
                nombre:'',
                apellido:'',
                telefono:'',
                direccion:'',
                fechaNacimiento:'',
                buscar:'',
                arrayApoderado:[]
            }
        },
        methods:{
            listar(buscar){
                let me=this;
                var url='/apoderado?buscar='+buscar;
                axios.get(url).then(function(response){
                    me.arrayApoderado=response.data;
                })
                .catch(function(error){
                    console:log(error);
                });
            },
            guardar(){
            let me = this;
            axios.post('apoderado/registrar',{
                'nombre': this.nombre,
                'apellido' : this.apellido,
                'telefono' : this.telefono,
                'direccion' : this.direccion,
                'fechaNacimiento' : this.fechaNacimiento,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },
            modificar(){
            let me = this;
            axios.put('apoderado/modificar',{
                'nombre': this.nombre,
                'apellido' : this.apellido,
                'telefono' : this.telefono,
                'direccion' : this.direccion,
                'fechaNacimiento' : this.fechaNacimiento, 
                'id': this.id,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },    
        eliminar(){
            let me = this;
            axios.put('apoderado/eliminar',{
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
            this.direccion=data['direccion'];
            this.fechaNacimiento=data['fechaNacimiento'];
        
        },   
            nuevo(){
                this.nombre='';
                this.apellido='';
                this.telefono='';
                this.direccion='';
                this.fechaNacimiento='';
                this.buscar='';
            }
        },
        mounted(){
            this.listar('');
        }
    }
 
 </script>
    