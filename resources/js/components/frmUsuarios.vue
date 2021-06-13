<template>
  <center>
    <div class="container">
      <br />
      <br />
      <h3>Gestion de Usuarios</h3>
      <form action="" method="$POST">
        <table>
          <tr>
            <td>username</td>
            <td>
              <input
                type="text"
                v-model="username"
                placeholder="username"
              />
            </td>
          </tr>
          <tr>
            <td>password</td>
            <td>
              <input type="text" v-model="password" placeholder="password" />
            </td>
          </tr>
          <tr>
            <td>rol</td>
            <td>
              <select v-model="rol" placeholder="rol">
                <option value="Administrador">Administrador</option>
                <option value="Estudiante">Estudiante</option>
                <option value="Profesor">Profesor</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <br />
              <br />
              <button type="button" @click="nuevo()">Nuevo</button>
              <button type="button" @click="guardar()">Guardar</button>
              <button type="button" @click="modificar()">Modificar</button>
              <button type="button" @click="eliminar()">Eliminar</button>
            </td>
          </tr>
        </table>
        <br />
        <br />
        <input type="text" v-model="buscar" placeholder="username" />
        <button type="button" @click="listar(buscar)">
          Buscar por username
        </button>
      </form>
      <br />
      <table border="1">
        <thead>
          <th>id</th>
          <th>username</th>
          <th>rol</th>
          <th>Opcion</th>
        </thead>
        <tbody>
          <tr v-for="users in arrayusers" :key="users.id">
            <td v-text="users.id"></td>
            <td v-text="users.username"></td>
            <td v-text="users.rol"></td>
            <td><a href="#" @click="llenar(users)">Seleccionar</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </center>
</template>

<script>
export default {
  data() {
    return {
      id: 0,
      username: "",
      password: "",
      rol: "",
      buscar: "",
      arrayusers: [],
    };
  },
  methods: {
    listar(buscar) {
      let me = this;
      var url = "/users?buscar=" + buscar;
      axios
        .get(url)
        .then(function (response) {
          me.arrayusers = response.data;
          console.log(me.arrayusers);
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    guardar() {
      let me = this;

console.log(this.password);
console.log(this.username);
      console.log(this.rol);
      axios
        .post("users/registrar", {
          username: this.username,
          password: this.password,
          rol: this.rol,
        })
        .then(function (error) {
          me.listar("");
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    modificar() {
      let me = this;
      axios
        .put("users/modificar", {
          username: this.username,
          password: this.password,
          rol: this.rol,
          id: this.id,
        })
        .then(function (error) {
          me.listar("");
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    eliminar() {
      let me = this;
      axios
        .put("users/eliminar", {
          id: this.id,
        })
        .then(function (error) {
          me.listar("");
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    llenar(data = []) {
      this.id = data["id"];
      this.username = data["username"];
      this.password = data["password"];
      this.rol = data["rol"];
    },
    nuevo() {
      this.username = "";
      this.password = "";
      this.direccion = "";
      this.rol = "";
      this.buscar = "";
    },
  },
  mounted() {
    this.listar("");
  },
};
</script>