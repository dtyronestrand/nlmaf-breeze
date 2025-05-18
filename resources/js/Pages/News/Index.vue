<template>
    <h1 class="text-7xl text-center text-[var(--color-text-primary)] mt-12 mb-12">No Limits News</h1>
<div v-for ="item in news" :key="item.id">
<article class="flex bg-[var(--color-primary-500)] border border-[var(--color-accent-500)] rounded-lg transition mx-auto hover:shadow-xl max-w-[50%] ">
<div class="text-[var(--color-text-primary)]  p-4 sm:!border-1-transparent sm:p-6 ">
{{ item.date }}
</div>
    <div class="flex flex-1 flex-col justify-between">
        <div class="border-s border-[var(--color-accent-500)] p-4 sm:!border-1-transparent sm:p-6">
            <a href="#">
                <h2 class="text-5xl text-[var(--color-text-primary)]">{{ item?.title }}</h2>
            </a>
            <p class="mt-8 line-clamp-3 text-lg/relaxed text-[var(--color-text-primary)] ">{{ item.description }}</p>
        </div>
  
        <div class="sm:flex sm:items-end sm:justify-end">
            <a href="#" class="block bg-[var(--color-accent-500)] px-5 py-3 text-center text-xs font-bold text-[var(--color-neutral-900)] uppercase transition hover:bg-[var(--color-accent-300)] mb-4 mr-4">
                Learn More
            </a>
        </div>
    </div>
</article>
</div>

</template>
<script setup lang="ts">
import { defineAsyncComponent } from 'vue';
interface Props {
news: Model.News[]

}
defineProps<Props>()
// Update the path below to the correct location of Image.vue
const BlockCommonImage = defineAsyncComponent(() => import('/Users/dev/Desktop/nlmaf-breeze/resources/js/Components/Theme/Block/Common/Image.vue'))
</script>