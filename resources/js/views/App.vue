<template>
  <div>
    <navbar></navbar>
    <div class="container py-5">
      <h1 class="text-center">Box Card</h1>
      <!-- per ogni oggetto all'interno dell'array posts, popolato tramite axios,
         ciclalo e passalo al componenente CardBox-->
      <card-box :posts="posts"/>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import navbar from "../components/navbar.vue";
import CardBox from "../components/CardBox.vue";

export default {
  components: {
    navbar,
    CardBox,
  },

  data() {
    return {
      posts: [],
    };
  },

  mounted() {
      axios.get("http://127.0.0.1:8000/api/posts").then((resp) => {
        this.posts = resp.data.data;
      });
  },
};
</script>

<style></style>
