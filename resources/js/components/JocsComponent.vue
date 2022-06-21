<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form @submit.prevent="editarJoc(joc)" v-if="modoEditar">
                        <h3>Editar joc</h3>
                        <input type="text" class="form-control mb-2" placeholder="Nom del joc" v-model="joc.nom">
                        <input type="text" class="form-control mb-2" placeholder="Imatge" v-model="joc.imatge">
                        <input type="text" class="form-control mb-2" placeholder="Núm de jug." v-model="joc.num_jug">
                        <button class="btn btn-warning" type="submit">Editar</button>
                        <button class="btn btn-danger" type="submit" @click="cancelarEdicion">Cancelar</button>
                    </form>
                    <form @submit.prevent="agregar(joc)" v-else>
                        <h3>Afegir joc:</h3>
                        <input type="text" class="form-control mb-2" placeholder="Nom del joc" v-model="joc.nom">
                        <input type="text" class="form-control mb-2" placeholder="Imatge" v-model="joc.imatge">
                        <input type="text" class="form-control mb-2" placeholder="Núm de jug." v-model="joc.num_jug">
                        <h6>Id de la sala</h6>
                        <select name="id_Sala" id="id_Sala" class="form-select"  v-model="joc.id_Sala">
                            <option  value="" selected></option>
                            <option v-for="sala in sales" :key="sala.nomSala" :value="sala.id">{{"Id de la sala: " + sala.id + " - Nom de la sala: " + sala.nomSala}}</option>
                        </select>
                        <br>
                        <button class="btn btn-primary" type="submit">Agregar</button>
                    </form>
                    <hr>
                    <h3>Lista de jocs:</h3>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(item, index) in jocs" :key="index">
                            <p>Nom del joc: {{ item.nom }}</p>
                            <p>Imatge: {{ item.imatge }}</p>
                            <p>Número de jug: {{ item.num_jug }}</p>
                            <p>
                                <button class="btn btn-warning btn-sm" @click="editarFormulario(item)">Editar</button>
                                <button class="btn btn-danger btn-sm" @click="eliminarJoc(item, index)">Eliminar</button>
                                <button class="btn btn-success btn-sm" @click="valoracioJoc(item, index)">Valoracio</button>
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
            jocs: [],
            sales: [],
            modoEditar: false,
            joc: {nom: '', imatge: '', num_jug: '', id_Sala: ''}
        }
    },
    created() {
        axios.get('/joc').
        then(res => {
            this.jocs = res.data;
        })
        axios.get('/sala').then(res => {
            this.sales = res.data;
        })

    },
    methods: {
        agregar() {
            if (this.joc.nom.trim() === '' || this.joc.imatge.trim() === '' || this.joc.num_jug.trim() === '') {
                alert('Debes completar todos los campos antes de guardar');
                return;
            }
            const params = {
                nom: this.joc.nom,
                imatge: this.joc.imatge,
                num_jug: this.joc.num_jug, 
                id_Sala: this.joc.id_Sala
                }

            axios.post('/joc', params)
                .then(res => {
                    jocs.push(res.data);
                    console.log(res.data)
                })

            this.joc.nom = '';
            this.joc.imatge = '';
            this.joc.num_jug = '';
            this.joc.id_Sala = 1;
        },

        editarFormulario(item) {
            this.modoEditar = true;
            this.joc.nom = item.nom;
            this.joc.imatge = item.imatge;
            this.joc.num_jug = item.num_jug;
            this.joc.id_Sala = 1;
            this.joc.id = item.id;
        },

        editarJoc(item) {
            axios.put(`/joc/${item.id}`, {nom: this.joc.nom,
                imatge: this.joc.imatge, num_jug: this.joc.num_jug, id_Sala: this.joc.id_Sala})
                .then(res => {
                    this.modoEditar = false;
                    const index = this.jocs.findIndex(jocBuscar => jocBuscar.id === res.data.id);
                    this.jocs[index] = res.data;

                    axios.get('/joc').then(res => {
                        this.jocs = res.data;
                    })

                })

            this.joc.nom = '';
            this.joc.imatge = '';
            this.joc.num_jug = '';
            this.joc.id_Sala = 1;
        },

        eliminarJoc(joc, index) {
            const confirmacion = confirm(`Eliminar joc ${joc.nom}`);
            if (confirmacion) {
                axios.delete(`/joc/${joc.id}`)
                    .then(() => {
                        this.jocs.splice(index, 1);
                    })
            }
        },

        cancelarEdicion() {
            this.modoEditar = false;
            this.joc = { nom: '', imatge: '', num_jug: ''};
            this.joc.id_Sala = 1;
        },

        valoracioJoc() {

        }
    }
}
</script>
