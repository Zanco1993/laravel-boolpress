<template>
  <div class="card-deck col-3 mb-5">
    <div class="card">
      <img
        class="card-img-top"
        :src="post.img ? post.img : 'https://via.placeholder.com/150'"
        alt="Card image cap"
      />
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <p class="card-text">
          {{ post.content }}
        </p>
        <p>Autore: {{ post.user.name }}</p>
        <p class="card-text">
          <small class="text-muted"
            >Aggiornato il {{ formatDate(post.updated_at) }}</small
          >
        </p>
        <div>
          <router-link :to="{ name: 'posts.show', params: { post: post.id } }"
            >Mostra dettagli</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import dayjs from "dayjs";
export default {
  props: {
    post: Object,
  },

  methods: {
    formatDate(date) {
      return dayjs(date).format("DD/MM/YYYY HH:mm");
    },
  },
};
</script>

<style>
</style>