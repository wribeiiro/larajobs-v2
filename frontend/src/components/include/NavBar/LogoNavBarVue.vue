<template>
    <div class="demo-image__preview">
        <el-image  :src="url" fit="contain" />
    </div>
</template>

<script>

export default {
    name: 'LogoNavBarVue',
    data() {
        return {
            url: './img/logo.svg'
        }
    }
}
</script>

<style scoped>
.demo-image__error .image-slot {
    font-size: 30px;
}

.demo-image__error .image-slot .el-icon {
    font-size: 30px;
}

.demo-image__error .el-image {
    width: 100%;
    height: 200px;
}
</style>
