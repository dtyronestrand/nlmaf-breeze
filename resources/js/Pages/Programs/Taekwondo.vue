<template>
<Head :item="item"></Head>
<h1><TextGenerate :words="words" :duration="2.5" class="text-[var(--color-text-primary)]  mb-12 mt-12 text-5xl md:text-7xl text-center text-balance"></TextGenerate></h1>
<section v-for="(headline, index) in headlines" :key="index" class="hero mb-8">
<div class="hero-inner" :id="'section-'+index ">
<figure :style="{ backgroundImage: 'url(' + headline.image + ')' }" class="hero__image">
</figure>
<h2 class="hero__title">{{ headline.title }}</h2>
<TextScrollReveal :text="headline.description" class="hero__description z-[100]"></TextScrollReveal>
</div>
</section>
<section class="content">
<article class="content-inner">
<h2 class="content__title">Taekwondo is More Than Just a Martial Art</h2>
<p >
Originating in Korea over 2,000 years ago, Taekwondo is a martial art that combines combat techniques, self-defense, sport, and exercise. The name "Taekwondo" is derived from the Korean words "Tae" (foot), "Kwon" (fist), and "Do" (way of life). This powerful yet graceful martial art is known for its high-flying kicks, swift strikes, and dynamic movements. But taekwondo is so much more, with regular practice, it can improve your overall health and well-being. 

 Our Taekwondo classes are designed for students of all ages, from young children to adults. Whether you are a beginner looking to learn the basics or an experienced practitioner aiming to refine your skills, our expert instructors will guide you every step of the way.
</p>
</article>
</section>


<div v-if="item?.blocks && Array.isArray(item.blocks) && item.blocks.length > 0">
<div v-for="(block, index) in item.blocks" :key="index">


<BlockCommonText v-if="block.type === 'common-text'" :block="block"></BlockCommonText>
</div>
</div>

</template>
<script setup lang="ts">
import Head from '@/Components/Theme/Head.vue'
import { defineAsyncComponent } from 'vue'
import ProgramsLayout from '@/Layouts/ProgramsLayout.vue'
import TextGenerate from '@/Components/Theme/UI/TextGenerate.vue'
import TextScrollReveal from '@/Components/Theme/UI/TextScroll/TextScrollReveal.vue'
interface Props {
    item: Model.Program
}
defineProps<Props>()
const words = 'What Can Taekwondo Do For You?'
const headlines =[ {
    title: 'Enhance Physical Fitness',
    description: 'Improve your strength, flexibility, and endurance through dynamic workouts.',
    image: '/assets/images/physical.png'
},
{
    title: 'Boost Mental Clarity',
    description: 'Develop focus, discipline, and resilience, reducing stress and enhancing mental clarity.',
    image: '/assets/images/mental.jpg'
},
{
    title: 'Build Self-Confidence',
    description: 'Gain a sense of accomplishment and self-assurance as you progress through the ranks and achieve your goals.',
    image: '/assets/images/confidence.jpg'
},
{
    title: 'Foster Community',
    description: 'Join a supportive and welcoming community where you can make new friends and build lasting relationships',
    image: '/assets/images/community.jpg'
}]
const BlockCommonHeading = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Heading.vue'))
const BlockCommonText = defineAsyncComponent(() => import('../../Components/Theme/Block/Common/Text.vue'))

// If the file is actually named Text.vue and located at the specified path, ensure it exists.
// If the file is named differently (e.g., CommonText.vue), update the import path accordingly:
// const BlockCommonText = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/CommonText.vue'))
</script>
<style scoped>
p{
    font-size: 1.25rem; 
    line-height: 1.5rem;
    color: var(--color-text-primary);
}
figure{
    display: flex;
    position:fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size:cover;

}
.hero{
    position:relative;
    width: 100vw;
    height: 100vh;
}

.hero-inner{
    position:absolute;
    overflow:hidden;
    width:100%;
    height:100%;
    clip:rect(0, auto, auto, 0);
}

.hero__title{
    display:flex;
    align-items:center;
    justify-content:center;
    position:fixed;
    top:0;
    left:0;
    padding:0 1rem;
    width:100%;
    height:100%;
    font-size: 8vw;
    letter-spacing: -0.125rem;
    text-align:center;
    color: var(--color-text-primary);
    text-shadow: 0 0 10px var(--color-accent-500);
}
.content{
    position:relative;
    margin: 0 auto 8rem;
    padding: 2rem;
    background-color:var(--color-primary-800)
}
.content::before{
    content: '';
    display:block;
    position:absolute;
    top: -100px;
    left:0;
    width:100%;
    height: 100px;
    background-color:var(--color-primary-800);
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);

}
.content__Inner{
    margin: 0 auto;
    max-width: 700px;
}
.content__inner > * + *{
    margin-top: 1.5rem;
}

.content__title{
    font-size: 3rem;
    line-height: 1.25;
    letter-spacing: -0.125rem;
    text-align:center;
    color: var(--color-text-primary);
    margin-bottom: 2rem;

}
</style>