<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form @submit.prevent="agregar">
                        <h3>Afegir valoracio:</h3>
                        <input type="text" class="form-control mb-2" placeholder="Puntuació" v-model="valoracio.puntuacio">
                        <input type="text" class="form-control mb-2" placeholder="Opinió" v-model="valoracio.opinio">
                        <h6>Id del joc</h6>
                        <select name="id_Joc" id="id_Joc" class="form-select"  v-model="valoracio.id_Joc">
                            <option  value="" selected></option>
                            <option v-for="joc in jocs" :key="joc.nom" :value="joc.id">{{"Id del joc: " + joc.id + " - Nom del joc: " + joc.nom}}</option>
                        </select>
                        <br>
                        <button class="btn btn-primary" type="submit">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            valoracions: [],
            jocs: [],
            modoEditar: false,
            valoracio: {puntuacio: '', opinio: ''}
        }
    },
    created() {
        axios.get('/valoracio').then(res => {
            this.valoracions = res.data;
        })

        axios.get('/joc').
        then(res => {
            this.jocs = res.data;
        })

    },
    methods: {
        agregar() {
            if (this.valoracio.puntuacio.trim() === '' || this.valoracio.opinio.trim() === '' ) {
                alert('Debes completar todos los campos antes de guardar');
                return;
            }
            axios.post('/valoracio', {puntuacio: this.valoracio.puntuacio,
                opinio: this.valoracio.opinio})
                .then(res => {
                    console.log(res.data)
                })
                .catch(error => {
                    console.log(error)
                })

            this.valoracio.puntuacio = '';
            this.valoracio.opinio = '';
        }
    }
}
</script>
