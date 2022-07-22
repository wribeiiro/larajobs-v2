<template>
    <div class="common-layout">
      <el-container>
        <el-header>
          <NavBarVue />
        </el-header>
        <el-main>Main</el-main>
        <el-footer>
          <FooterVue />
        </el-footer>
      </el-container>
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