<script setup lang="ts">
import Head from "../Components/Theme/Head.vue";
import WavyBackground from "../Components/Theme/UI/WavyBackground.vue";
defineOptions({
    layoutName: "Default",

});

interface Props {
    item: Model.Page;
}

defineProps<Props>();
let colors=["#406db3", "#d6682f", "#d6b522"];
let backgroundFill = "#161616";
let blur=6;
</script>

<template>
   
    <Head :item="item"></Head>
    <WavyBackground :colors="colors" :blur="blur" :backgroundFill="backgroundFill"> 
        <h1 class="text-center text-4xl font-semibold text-gray-900">
            {{ item.title }}
        </h1>
    </WavyBackground>
</template>
<style scoped>
body{
    background-color: blue;
}
</style>