<template>
  <el-row :gutter="10">
    <el-col :span="24" class="text-center font">
      {{this.getMessage()}}
    </el-col>
  </el-row>
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