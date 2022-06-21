<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form @submit.prevent="editarReserva(reserva)" v-if="modoEditar">
                        <h3>Editar reserva</h3>
                        <input type="text" class="form-control mb-2" placeholder="Nom de la reserva" v-model="reserva.nom">
                        <input type="date" class="form-control mb-2" placeholder="Data de la reserva" v-model="reserva.data">
                        <input type="text" class="form-control mb-2" placeholder="Email de la reserva" v-model="reserva.email">
                        <input type="text" class="form-control mb-2" placeholder="Telefon de la reserva" v-model="reserva.telefon">
                        <input type="text" class="form-control mb-2" placeholder="Pais de la reserva" v-model="reserva.pais">
                        <button class="btn btn-warning" type="submit">Editar</button>
                        <button class="btn btn-danger" type="submit" @click="cancelarEdicion">Cancelar</button>
                    </form>
                    <form @submit.prevent="agregar" v-else>
                        <h3>Afegir reserva:</h3>
                        <input type="text" class="form-control mb-2" placeholder="Nom de la reserva" v-model="reserva.nom">
                        <input type="date" class="form-control mb-2" placeholder="Data de la reserva" v-model="reserva.data">
                        <input type="text" class="form-control mb-2" placeholder="Email de la reserva" v-model="reserva.email">
                        <input type="text" class="form-control mb-2" placeholder="Telefon de la reserva" v-model="reserva.telefon">
                        <input type="text" class="form-control mb-2" placeholder="Pais de la reserva" v-model="reserva.pais">
                        <h6>Id de la sala</h6>
                        <select name="id_Sala" id="id_Sala" class="form-select"  v-model="reserva.id_Sala">
                            <option  value="" selected></option>
                            <option v-for="sala in sales" :key="sala.nomSala" :value="sala.id">{{"Id de la sala: " + sala.id + " - Nom de la sala: " + sala.nomSala}}</option>
                        </select>
                        <br>
                        <button class="btn btn-primary" type="submit">Agregar</button>
                    </form>
                    <hr>
                    <h3>Lista de reserves:</h3>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(item, index) in reserves" :key="index">
                            <p>Nom de la reserva: {{ item.nom }}</p>
                            <p>Data de la reserva: {{ item.data }}</p>
                            <p>Email de la reserva: {{ item.email }}</p>
                            <p>Telefon de la reserva: {{ item.telefon }}</p>
                            <p>Pais de la reserva: {{ item.pais }}</p>
                            <p>
                                <button class="btn btn-warning btn-sm" @click="editarFormulario(item)">Editar</button>
                                <button class="btn btn-danger btn-sm" @click="eliminarReserva(item, index)">Eliminar</button>
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
            reserves: [],
            sales: [],
            modoEditar: false,
            reserva: {nom: '',data: '', email: '', telefon: '', pais: ''}
        }
    },
    created() {
        axios.get('/reserva').then(res => {
            this.reserves = res.data;
        })

        axios.get('/sala').then(res => {
            this.sales = res.data;
        })

    },
    methods: {
        agregar() {
            if (this.reserva.nom.trim() === '' || this.reserva.data.trim() === '' || this.reserva.email.trim() === '' || this.reserva.telefon.trim() === '' || this.reserva.pais.trim() === '') {
                alert('Debes completar todos los campos antes de guardar');
                return;
            }
            axios.post('/reserva', {nom: this.reserva.nom, data: this.reserva.data, email: this.reserva.email, telefon: this.reserva.telefon, pais: this.reserva.pais})
                .then(res => {
                    console.log(res.data)
                })
                .catch(error => {
                    console.log(error)
                })

            console.log(this.reserva.nom);
            console.log(this.reserva.email);
            console.log(this.reserva.telefon);
            console.log(this.reserva.pais);


            this.reserva.nom = '';
            this.reserva.data = '';
            this.reserva.email = '';
            this.reserva.telefon = '';
            this.reserva.pais = '';
        },

        editarFormulario(item) {
            this.modoEditar = true;
            this.reserva.nom = item.nom;
            this.reserva.data = item.data;
            this.reserva.email = item.email;
            this.reserva.telefon = item.telefon;
            this.reserva.pais = item.pais;
            this.reserva.id = item.id;
        },

        editarReserva(item) {
            axios.put(`/reserva/${item.id}`, {nom: this.reserva.nom, data: this.reserva.data, email: this.reserva.email, telefon: this.reserva.telefon, pais: this.reserva.pais})
                .then(res => {
                    this.modoEditar = false;
                    const index = this.reserves.findIndex(reservaBuscar => reservaBuscar.id === res.data.id);
                    this.reserves[index] = res.data;

                    axios.get('/reserva').then(res => {
                        this.reserves = res.data;
                    })
                })

            this.reserva.data = '';
        },

        eliminarReserva(reserva, index) {
            const confirmacion = confirm(`Eliminar reserva ${reserva.nom}`);
            if (confirmacion) {
                axios.delete(`/reserva/${reserva.id}`)
                    .then(() => {
                        this.reserves.splice(index, 1);
                    })
            }
        },

        cancelarEdicion() {
            this.modoEditar = false;
            this.reserva = { data: ''};
        }
    }
}
</script>
