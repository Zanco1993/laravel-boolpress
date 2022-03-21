<template>
  <div>
    <div class="container">
      <h1>Questi sono i dettagli del prodotto</h1>
      <ul>
        <li>Il titolo è: {{ post.title }}</li>
        <li>Il contenuto è: {{ post.content }}</li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      post: {},
    };
  },
  mounted() {
      axios.get('http://127.0.0.1:8000/api/posts/' + this.$route.params.post).then((resp) => {
            this.post = resp.data
            console.log(this.post);
        });   
  },
};
</script>

<style>
</style>