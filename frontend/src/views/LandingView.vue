<template>
  <div class="container">
    <div class="row text-center">
      <div class="col-md-4 col-sm-12 align-self-center">
        <main class="px-3">
          <h1>{{ message.title }}</h1>
          <p class="lead">{{ message.subtitle }}</p>
          <p class="lead">
            <a href="#" class="btn btn-lg btn-primary">Saiba mais</a>
          </p>
        </main>
      </div>
      <div class="col-md-8 col-sm-12">
        <img src="img/home.jpg" class="img-fluid" alt="...">
      </div>
    </div>
  </div>

</template>

<script>

export default {
  name: 'LandingView',
  data() {
    return {
      message: { title: 'Conectamos', subtitle: 'developers validados às empresas' }
    }
  },
  components: {

  }
}
</script>
<style scoped>
.btn-secondary,
.btn-secondary:hover,
.btn-secondary:focus {
  color: #333;
  text-shadow: none;
}

body {
  text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
  box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
}

.cover-container {
  max-width: 42em;
}
</style>

