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

const submitRegister = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
const submitLogin = () => {
    form.post(route('login'));
};
const displayForm = ref('register');
const forgotPassword = ()=> {
  form.post(route('/forgot-password'))
}
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
        <Head title="Register" />
        <WordList :words="words" />
<div class="formwarp ">
<div class="login-register">
<div class="register form">
          <form
          id="register"
           :class="displayForm === 'register' ? '' : 'hidden'"
            @submit.prevent="submitRegister">
            <div class="form-header"></div>
            <div class="form-group">
            <InputLabel for="first_name" value="First Name" />
            <TextInput
          v-model="form.first_name"
              id="first_name"
              type="text"
              class="input" />
           <InputError :message="form.errors.first_name" class="mt-2" />
           </div>
           <div class="form-group">
            <InputLabel for="last_name" value="Last Name" />
          
            <TextInput
          v-model="form.last_name"
                id="last_name"

              type="text"
              class="input" />
            <InputError :message="form.errors.last_name" class="mt-2" />
            </div>
            <div class="form-group">
            <InputLabel for="email" value="Email" />
            <TextInput
          v-model="form.email"
              id="email"
              type="email"
              class="input" />
<InputError :message="form.errors.email" class="mt-2" />
</div>
<div class="form-group">
            <InputLabel for="pass" value="Password" />
            <TextInput
          v-model="form.password"
              id="pass"
              type="password"
              class="input" />
<InputError :message="form.errors.password" class="mt-2" />
</div>
<div class="form-group">
            <InputLabel for="confirm-pass" value="Confirm Password" />
            <TextInput
          v-model="form.password_confirmation"
              id="confirm-pass"
              type="password"
              class="input" /><InputError :message="form.errors.password_confirmation" class="mt-2" />
              </div>
              <div class="form-bottom">
            <button type="submit"class="group flex items-center justify-between gap-4 rounded-lg border border-[var(--color-accent)] bg-[var(--color-accent)] px-5 py-3 transition-colors hover:bg-transparent focus:ring-3 focus:outline-hidden" >  <span class="font-bold text-[var(--color-inverse-text))] text-xl transition-colors group-hover:text-[var(--color-accent)]">Sign Up</span>   <span class="shrink-0 rounded-full border border-current bg-[var(--color-accent-300)] p-2 text-[var(--color-text-inverse)] group-hover:bg-transparent group-hover:border-[var(--color-accent)]  group-hover:text-[var(--color-accent)] transition-colors">
        <svg
          class="size-5 shadow-sm rtl:rotate-180"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M17 8l4 4m0 0l-4 4m4-4H3"
          />
        </svg>
      </span></button>
            <br/>
            <button  type="button" @click="displayForm='login'" class="mt-4 text-neutral-100 already-registered">Already have an account? Login</button>
            </div>
          </form>
          <form :class="displayForm === 'forgot-password' ? '' : 'hidden'"  @submit.prevent="forgotPassword" id="forgot-password" >
            <div class="form-header"></div>
            <div class="form-group"><InputLabel for="email" value="Email" />
            <TextInput
              v-model="form.email"
              id="email"
              type="email"
              class="input" />
        </div>
        <IconButton type="submit" class="submit-btn">Send Password Reset Link</IconButton>
        </form>
       
            <form
            id="login"
              class="form-holder"
              @submit.prevent="submitLogin "  :class="displayForm === 'login' ? '' : 'hidden'">
              <InputLabel for="email" value="Email" />
              <TextInput
                v-model="form.email"
                id="email"
                type="email"
                class="input" /><InputError :message="form.errors.email" class="mt-2" />
              <InputLabel class="mt-5" for="pass" value="Password" />
              <TextInput
                v-model="form.password"
                id="pass"  
type="password"
                class="input" /><InputError :message="form.errors.password" class="mt-2" />
              <button type="button" @click="displayForm='forgot-password'" class="forgot-pass mt-10 text-[var(--color-primary-100)] mb-5">Forgot Password?</button><br/>
              <button type="button" @click="displayForm='register'" class="register-btn text-[var(--color-primary-100)] mb-5">Don't have an account? Register</button><br/>
              <IconButton type="submit" class="submit-btn">LOGIN</IconButton>
            </form>
        
          </div>
          </div>
  </div>
  
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
