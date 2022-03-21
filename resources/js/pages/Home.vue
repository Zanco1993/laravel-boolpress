<template>
  <div>
    <div class="container py-5">

      <h1 class="text-center">Box Card</h1>


      <!-- per ogni oggetto all'interno dell'array posts, popolato tramite axios,
         ciclalo e passalo al componenente CardBox-->
         <card-box :posts="posts" />

         
    </div>

    <div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a
              class="page-link"
              aria-label="Previous"
              @click="scrollerPost(posts.current_page - 1)"
            >
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>


          <li class="page-item" v-for="page in posts.last_page" :key="page">
            <a class="page-link" @click="currentPages(page)" href="#">{{
              page
            }}</a>
          </li>


          <li class="page-item">
            <a
              class="page-link"
              @click="scrollerPost(posts.current_page + 1)"
              aria-label="Next"
            >
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import CardBox from "../components/CardBox.vue";

export default {
  components: {
    CardBox,
  },

  data() {
    return {
      posts: [],
    };
  },

  mounted() {
    axios.get("http://127.0.0.1:8000/api/posts").then((resp) => {
      // entro nella paginazione di 5 post alla volta
      this.posts = resp.data;
    });
  },

  methods: {
    scrollerPost(page = 1) {
      if (page < 1) {
        page = 1;
      }

      if (page > this.posts.last_page) {
        page = this.posts.last_page;
      }

      axios.get("http://127.0.0.1:8000/api/posts?page=" + page).then((resp) => {
        this.posts = resp.data;
      });
    },
    currentPages(page) {
      axios.get("http://127.0.0.1:8000/api/posts?page=" + page).then((resp) => {
        this.posts = resp.data;
      });
    },
  },
};
</script>

<style></style>
