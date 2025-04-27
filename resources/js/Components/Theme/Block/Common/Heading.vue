<template>
<component v-if="block.content.heading" :is="headingTag">
    {{block.content.heading}}
</component>
</template>
<script setup lang="ts">
import {computed} from 'vue';
defineOptions({
    name: 'BlockCommonHeading',
})

interface Props {
    block: Model.Block & PropsBlock
}

type PropsBlock = {
    content: {
        heading?: string | null
        level?: string | null
    }
}

const props = defineProps<Props>();
    const validHeadingLevels: ReadonlyArray<string> = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
const headingTag = computed(()=>{
    const level = props.block.content.level;
    if (level && validHeadingLevels.includes(level)){
        return level;
    }
    return h2;
});
</script>