<script setup lang="ts">
import Heading from './Heading.vue'
import {Link} from '@inertiajs/vue3';
defineOptions({
    name: 'BlockCommonHero',
})
interface Props {
    block: Model.Block & PropsBlock
}
type PropsBlock = {
    content: {
        button_link?: string | null
        button_text?: string | null
    }
    medias:{
        image?: Media | MediaWithRoles | null
    }
    childs:{
        blocks?: Model.Block[] | null
    }
    
}
defineProps<Props>();

</script>
<template>
    <div v-if="block.childs" class="flex flex-col items-center justify-center text-center">
        <div v-for="(child,index) in block.childs" :key="index">
            <Heading class="text-white text-7xl" v-if="child.type == 'common-heading'" :block="child"></Heading>
        </div>
    </div>
    <img v-if="block.medias.image" :src="block.medias.image.default.src" height="500ox" width="500px" alt="Hero Image" class=" rounded-full mb-4 mt-12">
    <div v-if="block.content.button_text && block.content.button_link" class="mt-4">
        <Link :href="block.content.button_link" class="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            {{ block.content.button_text }}
        </Link>
        </div>
    </template>