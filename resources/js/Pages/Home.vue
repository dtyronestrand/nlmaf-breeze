<script setup lang="ts">
import Head from "../Components/Theme/Head.vue";
import WavyBackground from "../Components/Theme/UI/WavyBackground.vue";
import { defineAsyncComponent } from "vue";
defineOptions({
    layoutName: "Default",

});

interface Props {
    item: Model.Page;
}
const BlockCommonHeading = defineAsyncComponent(() => import("../Components/Theme/Block/Common/Heading.vue"));
const BlockCommonHero = defineAsyncComponent(() => import("../Components/Theme/Block/Common/Hero.vue"));
defineProps<Props>();
let colors=["#406db3", "#d6682f", "#d6b522"];
let backgroundFill = "#161616";
let blur=6;
</script>

<template>
   
    <Head :item="item"></Head>

        <div
    v-if="item?.blocks && Array.isArray(item.blocks) && item.blocks.length > 0"
    class="mx-auto mt-20 w-full max-w-6xl"
  >
    <div
      v-for="(block, index) in item.blocks"
      :key="index"
    >
      <BlockCommonHeading
        v-if="block.type == 'common-heading'"
        :block="block"
      ></BlockCommonHeading>
        <BlockCommonHero
            v-if="block.type == 'common-hero'"
            :block="block"></BlockCommonHero>
    </div>
  </div>
  
</template>
<style scoped>

</style>