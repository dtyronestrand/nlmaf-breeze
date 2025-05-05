<script setup  lang="ts">
import Head from '@/Components/Theme/Head.vue'
import { defineAsyncComponent } from 'vue'

interface Props {
    item: Model.Page
    locale: string
}
defineProps<Props>()
const BlockCommonHeading = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Heading.vue'))
const BlockCommonCardblock = defineAsyncComponent(() => import('../Components/Theme/Block/Common/Cardblock.vue'))
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
      <BlockCommonCardblock
        v-if="block.type == 'common-cardblock'"
        :block="block"></BlockCommonCardblock>
    </div>
  </div>
</template>