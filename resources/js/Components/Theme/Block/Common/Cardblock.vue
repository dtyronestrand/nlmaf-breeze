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
<div v-else>
<h1 class="text-[var(--color-text-primary)] text-center text-5xl md:text-7xl text-balance ">{{block.content.heading}}</h1>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
  <div v-for="(child, index) in block.childs" :key="index" class="bg-white rounded-lg shadow-lg p-6 image-area">
  <div class="img-wrapper">
  <img :src="child.medias.image.default.src" alt="child.content.heading"/>
    <h2 class="text-xl font-semibold mb-4">{{ child.content.heading }}</h2>
   <p>{{child.content.details}}</p>
   </div>
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
box-shadow: 0 0.5em 2em rgba(0, 0, 0, 0.1), 0 1em 2em rgba(0, 0, 0, 0.1);
background-color: rgba( 18,18,18,0.5);
backdrop-filter: blur(5px);
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

.image-area
{
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
position: absolute;
}

.img-wrapper
{
width: 300px;
height: 400px;
position: relative;
overflow: hidden;
}

.img-wrapper:before
{
content: '';
position: absolute;
top: 0;
left: 180%;
height: 100%;
width: 100%;
background: rgba(255,255,255,.3);
z-index: 1;
transform: skew(45deg);
transition: .5s;
}

.img-wrapper:hover:before
{
left: -180%;
}

.img-wrapper img
{
height: 500px;
width: 400px;
filter: grayscale(100%);
transition: 2s;
}
.img-wrapper:hover img
{
filter: grayscale(0%);
transform: scale(1.1);
}

.img-wrapper h2
{
background: var(--color-primary-500);
font-family: Poppins;
color: var(--color-text-primary);
text-align: center;
text-transform: uppercase;
margin: 0;
padding: 10px 0;
position: absolute;
bottom: 0;
width: 100%;
transform: perspective(400px) rotateY(90deg);
transform-origin: right;
transition: 1s;
}

.img-wrapper:hover h2
{
transform: perspective(400px) rotateY(0deg);
}

.img-wrapper ul
{
position: absolute;
top: 0;
left: 0;
margin: 0;
padding: 0;
list-style: none;
background: var(--color-base-500);
}

.img-wrapper ul li
{
background: var(--color-base-500);
height: 40px;
width: 40px;
text-align: center;
line-height: 1em;
transform: perspective(800px) rotateY(90deg);
transition: .5s;
transform-origin: left;
}

.img-wrapper:hover ul li
{
transform: perspective(800px) rotateY(0deg);
}

.img-wrapper:hover ul li:nth-child(1)
{
transition-delay: .2s;
}

.img-wrapper:hover ul li:nth-child(2)
{
transition-delay: .6s;
}

.img-wrapper:hover ul li:nth-child(3)
{
transition-delay: .8s;
}

.img-wrapper:hover ul li:nth-child(4)
{
transition-delay: 1s;
}

.img-wrapper ul li a
{
color: tomato;
background: rgba(255,255,255,0);
}

.img-wrapper ul li i
{
color: tomato;
background: rgba(255,255,255,0);
}

.img-wrapper ul li i:hover
{
color: #fff;
background: rgba(255,255,255,0);
}
</style>
