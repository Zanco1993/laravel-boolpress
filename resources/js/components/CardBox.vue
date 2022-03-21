<template>
  <div class="row">
    <!-- nella chiamata axios ho inserito in un unico array, le informazioni di
    pagination e data.
    Per questo motivo per accedere all'informazione di post, l'array sarà posts.data -->
    <card v-for="post in posts.data" :key="post.id" :post="post"></card>
  </div>
</template>

<script>
import Card from './Card.vue';


export default {
  components: {
    Card
  },
  props: {
    posts: Array
  }
  
};
</script>

<style>
</style>