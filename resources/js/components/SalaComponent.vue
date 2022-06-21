<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <form @submit.prevent="editarSala(sala)" v-if="modoEditar">
            <h3>Editar sala</h3>
            <input type="text" class="form-control mb-2" placeholder="Nom de la sala" v-model="sala.nomSala">
            <input type="text" class="form-control mb-2" placeholder="Capacitat" v-model="sala.capacitat">
            <button class="btn btn-warning" type="submit">Editar</button>
            <button class="btn btn-danger" type="submit" @click="cancelarEdicion">Cancelar</button>
          </form>
          <form @submit.prevent="agregar" v-else>
            <h3>Afegir sala:</h3>
              <input type="text" class="form-control mb-2" placeholder="Nom de la sala" v-model="sala.nomSala">
              <input type="text" class="form-control mb-2" placeholder="Capacitat" v-model="sala.capacitat">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </form>
          <hr>
          <h3>Lista de sales:</h3>
          <ul class="list-group">
            <li class="list-group-item" v-for="(item, index) in sales" :key="index">
              <p>Nom de la sala: {{ item.nomSala }}</p>
              <p>Capacitat de la sala: {{ item.capacitat }}</p>
              <p>
                <button class="btn btn-warning btn-sm" @click="editarFormulario(item)">Editar</button>
                <button class="btn btn-danger btn-sm" @click="eliminarSala(item, index)">Eliminar</button>
                <button class="btn btn-primary btn-sm" @click="afegirJoc(item, index)">Jocs</button>
                <button class="btn btn-success btn-sm" @click="afegirReserva(item, index)">Reservar</button>
              </p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sales: [],
      modoEditar: false,
      sala: {nomSala: '', capacitat: ''}
    }
  },
  created() {
    axios.get('/sala').then(res => {
      this.sales = res.data;
    })

  },
  methods: {
    agregar() {
      if (this.sala.nomSala.trim() === '' || this.sala.capacitat.trim() === '' ) {
        alert('Debes completar todos los campos antes de guardar');
        return;
      }
      axios.post('/sala', {nomSala: this.sala.nomSala,
          capacitat: this.sala.capacitat})
        .then(res => {
          console.log(res.data)
        })
        .catch(error => {
          console.log(error)
        })

        this.sala.nomSala = '';
        this.sala.capacitat = '';
    },

    editarFormulario(item) {
      this.modoEditar = true;
      this.sala.nomSala = item.nomSala;
      this.sala.capacitat = item.capacitat;
      this.sala.id = item.id;
    },

    editarSala(item) {
      axios.put(`/sala/${item.id}`, {nomSala: this.sala.nomSala,
          capacitat: this.sala.capacitat})
        .then(res => {
          this.modoEditar = false;
          const index = this.sales.findIndex(salaBuscar => salaBuscar.id === res.data.id);
          this.sales[index] = res.data;

            axios.get('/sala').then(res => {
                this.sales = res.data;
            })

        })

        this.sala.nomSala = '';
        this.sala.capacitat = '';
    },

    eliminarSala(sala, index) {
      const confirmacion = confirm(`Eliminar sala ${sala.nomSala}`);
      if (confirmacion) {
        axios.delete(`/sala/${sala.id}`)
          .then(() => {
            this.sales.splice(index, 1);
          })
      }
    },

    cancelarEdicion() {
      this.modoEditar = false;
      this.sala = { nomSala: '', capacitat: '' };
    },

      afegirJoc(sala, index) {
        return '/joc';
      },

      afegirReserva(sala, index) {
          return '/reserva';
      }
  }
}
</script>
