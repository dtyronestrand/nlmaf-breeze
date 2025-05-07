<template>

    <div v-if="block.content.type === 'default'">
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
</div>
<div class="mt-[100px] relative" v-else-if="block.content.type === 'stack'">

<h1 class="text-[var(--color-text-primary)] text-center text-5xl md:text-7xl text-balance ">{{block.content.heading}}</h1>

<ul id="cards">
<li v-for="(child, index) in block.childs" :key="index" class="card" id="`card-${index}`">
    <div class="card-content">
    <div>
        <h2 class="card-title" v-html="goldText(child.content.heading)"></h2>
        <p class="card-details">{{ child.content.details }}</p>
        </div>
        <figure v-if="child.medias.image" class="card-image">
            <img :src="child.medias.image.default.src" alt="Child Image" class="w-full h-auto rounded-lg">
        </figure>
    </div>
</li>
</ul>
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

function goldText(sentence: string) {
  const words = sentence.split(' ')
  const lastTwo = words.slice(-2).join(' ')
  const remaining = words.slice(0, -2).join(' ')
  return `${remaining} <span class="bg-gradient-to-b from-yellow-200 to-yellow-500 bg-clip-text not-italic text-transparent">${lastTwo}</span>`
}
</script>
<style scoped>

#cards {
  list-style: none;
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows: repeat(var(--numcards), var(--card-height));
  gap: var(--card-margin);
  padding-bottom: calc(var(--numcards) * var(--card-top-offset));
  margin-bottom: var(--card-margin);
}

#card-1 {
  --index: 1;
}

#card-2 {
  --index: 2;
}

#card-3 {
  --index: 3;
}

#card-4 {
  --index: 4;
}

.card {
  position: sticky;
  top: 0;
  padding-top: calc(var(--index) * var(--card-top-offset));
}

.card-content {
  box-shadow: 0 0.2em 1em rgba(0, 0, 0, 0.1), 0 1em 2em rgba(0, 0, 0, 0.1);
  background-color: rgba( 18,18,18,0.4);
  backdrop-filter: blur(10px);
  border:2px solid var(--color-primary-500);
  color: var(--color-text-primary);
  border-radius: 2rem;
  overflow: hidden;
  display: grid;
  grid-template-areas: "text img";
  grid-template-columns: 1fr 1fr;
  grid-template-rows: auto;
  align-items: stretch;
  padding: 1.4em;
}

.card-content > div {
  grid-area: text;
  width: 95%;
  max-width: 800px;
  place-self: center;
  text-align: left;
  display: grid;
  gap: 1em;
  place-items: start;
}

.card-content > figure {
  grid-area: img;
  overflow: hidden;
}

.card-content > figure > img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: .4em;
}

h1 {
  font-weight: 300;
  font-size: 5rem;
  margin-bottom: 3rem;
}

h2 {
  font-weight: bold;
  font-size: 2.5rem;

  margin: 0;
}

p {
  font-weight: 300;
  line-height: 1.72;
  font-size: 1.5rem;
}

/* Animation */
@supports (animation-timeline: works) {

  @scroll-timeline cards-element-scrolls-in-body {
    source: selector(body);
    scroll-offsets:
      selector(#cards) start 1,
      selector(#cards) start 0
    ;
    start: selector(#cards) start 1;
    end: selector(#cards) start 0;
    time-range: 4s;
  }

  .card {
    --index0: calc(var(--index) - 1);
    --reverse-index: calc(var(--numcards) - var(--index0));
    --reverse-index0: calc(var(--reverse-index) - 1);
  }
  
  .card__content {
    transform-origin: 50% 0%;
    will-change: transform;

    --duration: calc(var(--reverse-index0) * 1s);
    --delay: calc(var(--index0) * 1s);

    animation: var(--duration) linear scale var(--delay) forwards;
    animation-timeline: cards-element-scrolls-in-body;
  }

  @keyframes scale {
    to {
      transform:
        scale(calc(
          1.1
          -
          calc(0.1 * var(--reverse-index))
        ));
    }
  }
}

</style>
