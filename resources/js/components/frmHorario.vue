<template>
<center>
    <div class='container'>
    <br>
    <br>
    <h3> Gestion de Horario </h3>
    <form action="" method="$POST">
        <table>
                <tr>
                    <td>HoraInicio</td>
                    <td><input type="time" v-model="horaInicio" placeholder="Hora Inicial"></td>
                </tr>
                <tr>
                    <td>HoraFinalizacion</td>
                    <td><input type="time" v-model="horaFinalizacion" placeholder="Hora Finalizacion"></td>
                </tr>
                <tr>
                    <td>Dia</td>
                    <td><input type="text" v-model="dia" placeholder="Dia"></td>
                </tr>
                 <tr>
                    <td>CodTurno</td>
                    <td><input type="text" v-model="codTurno" placeholder="CodTurno"></td>
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
        <input type="text" v-model="buscar" placeholder="Horario">
        <button type="button" @click="listar(buscar)">Buscar Horario</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <th>id</th>
            <th>HoraInicio</th>
            <th>HoraFinalizacion</th>
            <th>Dia</th>
            <th>CodTurno</th>
            <th>Opcion</th>
        </thead>
        <tbody>
            <tr v-for="horario in arrayHorario" :key="horario.id">
                <td v-text="horario.id"></td>
                <td v-text="horario.horaInicio"></td>
                <td v-text="horario.horaFinalizacion"></td>
                <td v-text="horario.dia"></td>
                <td v-text="horario.codTurno"></td>
                <td><a href="#" @click="llenar(horario)">Seleccionar</a></td>
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
            horaInicio: '',
            horaFinalizacion: '',
            dia: '',
            buscar : '',
            arrayHorario : []
        }
    },
    methods:{
        listar(buscar){
            let me = this;
            var url='/horario?buscar='+buscar;
            axios.get(url).then(function(response){
                me.arrayHorario= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },

        guardar(){
            let me = this;
            axios.post('horario/registrar',{
                'horaInicio': this.horaInicio,
                'horaFinalizacion' : this.horaFinalizacion,
                'dia' : this.dia,
                'codTurno' : this.codTurno
                
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },

        modificar(){
            let me = this;
            axios.put('horario/modificar',{
                'horaInicio': this.horaInicio,
                'horaFinalizacion' : this.horaFinalizacion,
                'dia' : this.dia,
                'codTurno' : this.codTurno,
                'id': this.id,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },


        eliminar(){
            let me = this;
            axios.put('horario/eliminar',{
              'id': this.id,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });               
        },

        llenar(data=[]){
            this.id=data['id'];
            this.horaInicio=data['horaInicio'];
            this.horaFinalizacion=data['horaFinalizacion'];
            this.dia=data['dia'];
            this.codTurno=data['codTurno'];
        },
        nuevo(){
            this.horaInicio = '';
            this.horaFinalizacion = '';
            this.dia ='';
            this.codTurno ='';
            this.buscar = '';
        },
    },       
    mounted(){
        this.listar('');
    }
}
</script>