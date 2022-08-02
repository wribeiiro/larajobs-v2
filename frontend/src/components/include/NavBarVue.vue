<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <router-link :to="'/'" class="navbar-brand" href="#"><img src="/img/logo.svg" alt="inicio"></router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-lg-flex justify-content-end" id="navbarCollapse">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
               <router-link :to="'/'" class="nav-link" aria-current="page">{{ menu.seeVaga }}</router-link>
            </li>
            <li class="nav-item">
               <router-link :to="'/login'" class="nav-link" aria-current="page">{{ menu.login }}</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>
<script>

export default {
  name: 'NavBarVue',
  data() {
    return {
      menu: {
        seeVaga: 'Ver vagas',
        login: 'Login'
      }
    }
  }
}
</script>

<style>
</style>
