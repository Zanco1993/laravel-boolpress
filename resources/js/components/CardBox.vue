<template>
  <div class="row">
    <card v-for="post in posts" :key="post.id" :post="post"></card>
  </div>
</template>

<script>
import Card from './Card.vue';


export default {
  components: {
    Card

  },
  props: {
    posts: Array,
  },
};
</script>

<style>
</style>