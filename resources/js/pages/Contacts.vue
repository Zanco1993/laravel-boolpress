<template>
    <div class="container">
        <h1>Questa è la pagina dei contatti</h1>
        <div v-if="formSend" class="alert alert-success py-5">
            <h3>Grazie per averci contattato.</h3>
            <p class="lead">
                Le risponderemo il prima possibile.
            </p>
        </div>
        <div v-else>
            <div class="form-group mb-3">

                <label>Name</label>
                <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter name"
                       v-model="formData.name">
            </div>
            <div class="form-group mb-3">
                <label>Email address</label>
                <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email"
                       v-model="formData.email">
            </div>
            <div class="form-group mb-3">
                <label>Example textarea</label>
                <textarea class="form-control" rows="3" placeholder="Inserisci il testo"
                          v-model="formData.text"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" @click="formSubmit()">Submit</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                name: '',
                email: '',
                text: '',
            },
            formSend: false
        }
    },
    methods: {
        async formSubmit() {
            this.formSend = false
            const res = await axios.post('/api/contacts', this.formData);
            // res.data
            this.formSend = true;

        }
    }
}
</script>

<style>

</style>
