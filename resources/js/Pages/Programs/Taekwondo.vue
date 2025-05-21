<template>

<div v-if="item?.blocks && Array.isArray(item.blocks) && item.blocks.length > 0">
<div v-for="(block, index) in item.blocks" :key="index">
<BlockCommonHeading v-if="block.type === 'common-heading'" :block="block"></BlockCommonHeading>
<BlockCommonText v-if="block.type === 'common-text'" :block="block"></BlockCommonText>
</div>
</div>

</template>
<script setup lang="ts">
import Head from '@/Components/Theme/Head.vue'
import { defineAsyncComponent } from 'vue'
import ProgramsLayout from '@/Layouts/ProgramsLayout.vue'

interface Props {
    item: Model.Program
}
defineProps<Props>()
const BlockCommonHeading = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Heading.vue'))
const BlockCommonText = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Text.vue'))
</script>