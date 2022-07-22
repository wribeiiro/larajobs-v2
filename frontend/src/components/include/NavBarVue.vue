<template>
  <el-menu :default-active="activeIndex" class="el-menu-demo font" mode="horizontal" :ellipsis="false"
    @select="handleSelect">
    <el-menu-item index="0">
      <LogoNavBarVue />
    </el-menu-item>
    <div class="flex-grow" />
    <el-menu-item class="hidden-md-and-down" index="1">{{ menu.seeVaga }}</el-menu-item>
    <el-menu-item class="hidden-md-and-down" index="2">{{ menu.login }}</el-menu-item>
    <el-sub-menu class="hidden-lg-and-up " index="3">
      <template #title>Menu</template>
      <el-menu-item index="3-1" class="font">{{ menu.seeVaga }}</el-menu-item>
      <el-menu-item index="3-2" class="font">{{ menu.login }}</el-menu-item>
    </el-sub-menu>
  </el-menu>
</template>

<script>
import LogoNavBarVue from './NavBar/LogoNavBarVue.vue'

export default {
  name: 'NavBarVue',
  data() {
    return {
      menu: {
        seeVaga: 'Ver Vagas',
        login: 'Login'
      }
    }
  },
  components: {
    LogoNavBarVue
  }
}
</script>

<style>
.flex-grow {
  flex-grow: 1;
}

.font {
  margin: 0;
  font-family: Poppins, Helvetica, Arial, sans-serif;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
}
</style>
