<template>
<h1 class="text-[var(--color-text-primary)] text-center text-5xl md:text-7xl text-balance ">{{block.content.heading}}</h1>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
    <div v-for="(child, index) in block.childs" :key="index" class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4">{{ child.content.heading }}</h2>
        <p class="text-gray-700 mb-4">{{ child.content.details }}</p>
        <div v-if="child.medias.image" class="mb-4">
            <img :src="child.medias.image.default.src" alt="Child Image" class="w-full h-auto rounded-lg">
        </div>
    </div>
</div>

</template>
<script setup lang="ts">
defineOptions({
    name: 'BlockCommonCardblock',
})
interface Props {
    block: Model.Block & PropsBlock
}
type PropsBlock = {
    content: {
        heading?: string | null
        type?: string | null
    }
    childs: PropsChildBlock[]
}
type PropsChildBlock = {
    content: {
        heading?: string | null
        details?: string | null
    }
    medias: {
        image?: Model.Media | Model.MediaWithRoles | null
    }
}
defineProps<Props>();
</script>