<template>
  <DefaultLayout>
    <div>
      <h1>Welcome Taekwondo Members</h1>
      <p>This is the exclusive members area for Taekwondo practitioners.</p>
    </div>
  </DefaultLayout>
</template>

<script setup lang="ts">
import DefaultLayout from '@/Layouts/DefaultLayout.vue'; // Assuming DefaultLayout exists
</script>

<style scoped>
h1 {
  font-size: 2em;
  text-align: center;
  margin-bottom: 1rem;
}
p {
  text-align: center;
}
</style>
