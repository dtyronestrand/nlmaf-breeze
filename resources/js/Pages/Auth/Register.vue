<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import WordList from '@/Components/Theme/UI/WordList.vue';
import IconButton from '../../Components/Theme/UI/IconButton.vue';
defineOptions({
    layoutName: 'GuestLayout',
});
const form = useForm({
   first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};

const words = [
  "joy",
  "happiness",
  "success",
  "challenge",
  "move",
  "change",
  "grow",
  "experience",
  "self",
  "journey",
  "sustainable"]
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
<div class="bg-cover bg-center bg-fixed" style="background-position: right top; background-image: url('/assets/images/formbg.webp')">
    <div class="h-screen flex justify-center items-center">
        <div class="bg-[rgba(6,6,6,0.5)] backdrop-blur-xl filter mx-4 mt-8 p-8 rounded-3xl border-2 border-[var(--color-accent-500)] shadow-md w-full md:w-1/2 lg:w-1/3">
            <h1 class="text-3xl font-bold mb-8 text-center text-[var(--color-text-primary)]">Register</h1>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <InputLabel for="first_name" value="First Name" class="font-semibold !text-[var(--color-text-primary)]" />
                    <TextInput
                        id="first_name"
                        type="text"
                        class="mt-1 block w-full border rounded py-2 px-3 text-[var(--color-text-primary)] leading-tight focus:outline-none focus:shadow-outline"
                        v-model="form.first_name"
                        required
                        autofocus
                        autocomplete="given-name"
                        placeholder="Enter your first name"
                    />
                    <InputError class="mt-2" :message="form.errors.first_name" />
                </div>
                <div class="mb-4">
                    <InputLabel for="last_name" value="Last Name" class="font-semibold !text-[var(--color-text-primary)]" />
                    <TextInput
                        id="last_name"
                        type="text"
                        class="mt-1 block w-full border rounded py-2 px-3 text-[var(--color-text-primary)] leading-tight focus:outline-none focus:shadow-outline"
                        v-model="form.last_name"
                        required
                        autocomplete="family-name"
                        placeholder="Enter your last name"
                    />
                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>
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
                <div class="mb-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" class="font-semibold !text-[var(--color-text-primary)]" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full border rounded py-2 px-3 text-[var(--color-text-primary)] leading-tight focus:outline-none focus:shadow-outline"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm your password"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>
                <div class="block mt-4 mb-4">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ms-2 text-sm text-[var(--color-text-primary)]">Remember me</span>
                    </label>
                </div>

                <PrimaryButton class="ms-4 bg-[var(--color-accent-500)] hover:bg-[var(--color-accent-700)] text-[var(--color-text-primary)]" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </form>
        </div>
    </div>
</div>
     
    </GuestLayout>
</template>
<style scoped>
.formwarp {
  height: 100vh;
  overflow-x: auto;

  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
}
.login-register {
  height: 100%;
  display: flex;
}
.form {
  background-color: var(--color-base-500);
  opacity: 0.8;
  width: 450px;
  margin: auto;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 0 15px 2px var(--color-accent-500);
}
.form .form-header {
  text-align: center;
  margin-bottom: 30px;
}
.form .form-header img {
  width: 80px;
}
.form .form-group {
  margin-bottom: 15px;
}
.form label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  cursor: pointer;
  color: var(--color-text-primary);
}
.form input {
  width: 100%;
  padding: 10px;
  border: 0;
  border-radius: 3px;
  color: var(--color-neutral-900);
}
.form input:focus {
  outline: none;
  box-shadow: 0 0 10px var(--color-accent-500);
}
.form-bottom {
  margin-top: 20px;
}
.form-bottom p {
  margin: 5px 0;
  color: var(--color-text-primary);
}
.form-bottom a {
  color: var(--color-text-primary);
  font-weight: bold;
  text-decoration: none;
}

  </style>
