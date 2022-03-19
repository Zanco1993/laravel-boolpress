<template>
  <div class="card-deck col-3">
      <div class="card">
        <img
          class="card-img-top"
          src="https://via.placeholder.com/150"
          alt="Card image cap"
        />
        <div class="card-body">
          <h5 class="card-title">{{ post.title }}</h5>
          <p class="card-text">
            {{ post.content }}
          </p>
          <p class="card-text">
            <small class="text-muted">Aggiornato {{ post.updated_at }}</small>
          </p>
        </div>
      </div>
    </div>
</template>

<script>
export default {
props: {
    post: Object
},
}
</script>

<style>

</style>