<template>
  <div class="row align-items-end">
    <div class="col">
      <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
          <span class="text-muted">{{ this.getMessage() }}</span>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>

export default {
  name: 'FooterVue',
  data() {
    return {
      text: 'Copyright © todos os direitos reservados'
    }
  },
  methods: {
    getMessage() {
      const date = new Date();

      return `${this.text} ${date.getFullYear()}`
    }
  }
}
</script>

<style>
.text-center {
  text-align: center;
}
</style>