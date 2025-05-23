<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
<div class="bg-cover bg-center bg-fixed" style="background-position: right top; background-image: url('/assets/images/formbg.webp')">
    <div class="h-screen flex justify-center items-center">
        <div class="bg-[rgba(6,6,6,0.5)] backdrop-blur-xl filter mx-4 mt-8 p-8 rounded-3xl border-2 border-[var(--color-accent-500)] shadow-md w-full md:w-1/2 lg:w-1/3">
            <h1 class="text-3xl font-bold mb-8 text-center text-[var(--color-text-primary)]">Login</h1>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <InputLabel for="email" value="Email Address" class="font-semibold !text-[var(--color-text-primary)]" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full border rounded py-2 px-3 text-[var(--color-text-primary)] leading-tight focus:outline-none focus:shadow-outline"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Enter your email address"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mb-4">
                    <InputLabel for="password" value="Password" class="font-semibold !text-[var(--color-text-primary)]" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full border rounded py-2 px-3 text-[var(--color-text-primary)] leading-tight focus:outline-none focus:shadow-outline"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block mt-4 mb-4">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ms-2 text-sm text-[var(--color-text-primary)]">Remember me</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6 mb-6">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-[var(--color-text-primary)] hover:text-[var(--color-secondary-500)] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Forgot your password?
                    </Link>

                    <PrimaryButton class="ms-4 bg-[var(--color-accent-500)] hover:bg-[var(--color-accent-700)] text-[var(--color-text-primary)]" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Login
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</div>
     
            </GuestLayout>
</template>
