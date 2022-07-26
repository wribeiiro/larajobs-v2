<template>
  <div class="container">
    <NavBarVue />
    <router-view></router-view>
    <FooterVue />
  </div>
</template>

<script>
import NavBarVue from './components/include/NavBarVue.vue';
import FooterVue from './components/include/FooterVue.vue';

export default {
  components: {
    NavBarVue,
    FooterVue
  }
}
</script>