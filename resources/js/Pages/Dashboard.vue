<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineOptions({
    layoutName: 'AuthenticatedLayout',
});
</script>

<template>
    <Head title="Dashboard" />


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-[var(--color-base-500)] shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-[var(--color-text-primary)]">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
  
</template>
