<template>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/">Laravel Boolpress</a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-bs-controls="navbarSupportedContent"
        aria-bs-expanded="false"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
          <li class="nav-item" v-for="route in routes" :key="route.path">
            <router-link :to="route.path" class="nav-link">{{route.meta.linktext}}</router-link>
          </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/login" v-if="!user"> Login </a>
            <a class="nav-link" href="/admin" v-if="user"> {{ user.name }} </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import axios from "axios";
import router from "../router";
export default {
  data() {
    return {
      routes: [],
      user: null
    };
  },
  mounted() {
    this.routes = this.$router
      .getRoutes()
      .filter((route) => route.meta.linktext);
    // console.log(this.routes);

    this.getNameUser();
  },
  methods: {
    getNameUser() {
      axios.get('http://127.0.0.1:8000/api/user').then((resp) => {
        this.user = resp.data
      })
    }
  }
};
</script>

<style>
</style>
