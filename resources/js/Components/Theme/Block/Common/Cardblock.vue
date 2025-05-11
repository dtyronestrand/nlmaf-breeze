<template>
  <div v-if="block.content.type === 'stack' ">
<div class ="main-wrapper" >
<div class="section">
<div class="container-medium" >
  <div class="max-width-large">
  <h1 class="heading text-center text-balance">{{ block.content.heading }} </h1>
  </div>
          </div>
        </div>
</div>
<div  class="scroll-section vertical-section section" ref="scrollSectionRef">
<div v-for="(child, index) in block.childs" :key="child.content.heading" :ref="el => setItemRef(el, index)" class="wrapper">
<div role="list" class="list" >
<div role="listitem" class="item" >
<div class="item_content">
<h2 v-html="goldText(child.content.heading)"></h2>
<p class="item_p">{{child.content.details  }}</p>
</div>
<img  class="item_media" :src="child.medias.image.default.src" :alt="child.content.headng">
</div>
</div>
</div>
</div>
</div>

<div   v-else-if="block.content.type === 'hover'">
<h1 class="heading text-center text-balance">{{ block.content.heading }} </h1>
<div class="flex flex-row gap-8" >
<div class="card  " v-for="child in block.childs"  :key="child.content.heading">
<div class="card-border-top">
</div>
<div class="img">
<img :src="child.medias.image.default.src" :alt="child.content.headng">
</div>
<span>{{ child.content.heading }}</span>
<p class="job">{{ child.content.details }}</p>
</div>
</div>
</div>
</template>
<script setup lang="ts">
import {ref, onMounted, onUnmounted, onBeforeUpdate, nextTick} from 'vue'
import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
import ScrollSmoother from 'gsap/ScrollSmoother'
gsap.registerPlugin(ScrollTrigger, ScrollSmoother)
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
    childs?: ChildProps[] | null

  }
  type ChildProps = {
content: {
  heading?: string | null
  details?: string | null

}
  medias?: {
    image?:  Model.MediaWithRoles | null
  }
}
const props = defineProps<Props>();
 function goldText(sentence: string) {
  const words = sentence.split(' ')
  const lastTwo = words.slice(-2).join(' ')
  const remaining = words.slice(0, -2).join(' ')
  return `${remaining} <span class="bg-gradient-to-b from-yellow-200 to-yellow-500 bg-clip-text not-italic text-transparent">${lastTwo}</span>`
}
const scrollSectionRef = ref<HTMLElement | null>(null)
const itemRefs = ref<HTMLElement[]>([])

const setItemRef = (el: unknown, index: number) => {
  if (el instanceof HTMLElement) {
    itemRefs.value[index] = el;
  } else if (el) {
    // Fallback for component instance refs if needed, though HTMLElement is expected here
    const element = (el as any).$el;
    if (element instanceof HTMLElement) {
        itemRefs.value[index] = element;
    }
  }
}

onBeforeUpdate(() => {
  // Clear refs before each update to allow them to be repopulated correctly
  itemRefs.value = []
})

let gsapCtx: gsap.Context | null = null;

onMounted(async () => {
  // Wait for Vue to finish DOM updates, especially for v-for elements
  await nextTick();

  gsapCtx = gsap.context(() => {
    const sectionElement = scrollSectionRef.value
    const itemElements = itemRefs.value.filter(el => el != null); // Ensure all refs are actual elements

    if (!sectionElement || itemElements.length === 0) {
      if (!sectionElement) console.warn('GSAP ScrollTrigger: scrollSectionRef is not available.');
      if (itemElements.length === 0 && props.block?.childs && props.block.childs.length > 0) {
        console.warn('GSAP ScrollTrigger: itemRefs are empty despite childs data existing.');
      }
      return; // Exit if essential elements are missing or no items to animate
    }

    // This component has 'vertical-section' class, so direction is vertical.
    const direction = "vertical";

    // Initial states: move all items (except the first) down
    itemElements.forEach((item, index) => {
      if (index !== 0) {
        gsap.set(item, { yPercent: 100 }); // For vertical stacking
      }
    });

    const timeline = gsap.timeline({
      scrollTrigger: {
        trigger: sectionElement,
        pin: true,
        start: "top top",
        end: () => `+=${itemElements.length * 100}%`, // Each item gets 100% viewport scroll
        scrub: 1, // Smooth scrubbing
        invalidateOnRefresh: true,
        // markers: true, // Uncomment for debugging
      },
      defaults: { ease: "none" } // Default ease for animations in this timeline
    });

    itemElements.forEach((item, index) => {
      timeline.to(item, { scale: 0.9, borderRadius: "10px" });
      if (index < itemElements.length - 1) { // If there's a next item
        timeline.to(itemElements[index + 1], { yPercent: 0 }, "<"); // Animate next item in, starting simultaneously
      }
    });
  }, scrollSectionRef.value || undefined); // Scope GSAP context to the scroll section
});

onUnmounted(() => {
  if (gsapCtx) {
    gsapCtx.revert(); // Cleans up all GSAP animations and ScrollTriggers created in this context
    gsapCtx = null;
  }
});

</script>
<style scoped>
h2 {
  margin-top: 0;
  margin-bottom: 1rem;
  font-size: 2rem;
  font-weight: 700;
  line-height: 1.2;
}

.heading {
  font-size: 5rem;
  height: 50vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-shadow: 0.04em 0.04rem 0 var(--color-accent-500);
  color: var(--color-text-primary);
}

.section {
  overflow: hidden;
  
}

.wrapper {
  height: 100vh;
  
}

.list {
  justify-content: flex-start;
  align-items: center;
  height: 100%;
  display: flex;
  position: relative;
  padding: 0.2rem;
}

.item {
  width: full;
  height: 50%;
  display: flex;
  position: absolute;
  inset: 0%;
  box-shadow: var(--color-accent) 0px 8px 24px;
  overflow: hidden;
}



.item_content {
  background-color: var(--color-base-900);
  color: var(--color-text-primary);
  flex-flow: column;
  justify-content: center;
  align-items: flex-start;
  padding: 3rem;
  display: flex;
  position: relative;
  width: 50%;
}

.item_media {
  object-fit: cover;
  width: 50%;
  height: 100%;
}

.padding-global {
  padding-left: 2.5rem;
  padding-right: 2.5rem;
}

.padding-vertical {
  padding: 2rem;
}

@media (max-width: 575.98px) {
  .heading {
    font-size: 2.5rem;
  }

  .item {
    display: flex;
    flex-direction: column;
  }

  .item_content,
  .item_media {
    height: 50vh;
    width: 100%;
    padding-top: 0;
    padding-bottom: 0;
  }

  .item_number {
    font-size: 0.5rem;
    top: 1.5rem;
  }
}
.card {
 width: 400px;
 height: 450px;
 background: var(--color-base-900);
 border-radius: 15px;
 box-shadow: 1px 5px 60px 0px var(--color-accent-500);
}

.card .card-border-top {
 width: 60%;
 height: 3%;
 background: var(--color-accent-500);
 margin: auto;
 border-radius: 0px 0px 15px 15px;
}

.card span {
 font-weight: 600;
 color: var(--color-text-primary);
 text-align: center;
 display: block;
 padding-top: 10px;
 font-size: 2rem;
}

.card .job {
 font-weight: 400;
 color: var(--color-text-primary);
 display: block;
 text-align: center;
 padding-top: 3px;
 font-size: 1.5rem;
}

.card .img {
 width: 250px;;
 height: 250px;
 background: var(--color-accent-500);
 border-radius: 15px;
 margin: auto;
 margin-top: 25px;
}


</style>