<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

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
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
        <Head title="Register" />
<div class="formwarp">
<div class="login-register">
<div class="register form">
          <form
          id="register"
            class="active"
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
            <PrimaryButton >Sign Up</PrimaryButton>
            <p class="already-registered">Already have an account?<Link href="/login">Login</Link></p>
            </div>
          </form>
          <form @submit.prevent="forgotPassword" id="forgot-password" >
            <div class="form-header"></div>
            <div class="form-group"><InputLabel for="email" value="Email" />
            <TextInput
              v-model="form.email"
              id="email"
              type="email"
              class="input" />
        </div>
        </form>
       
            <form
            id="login"
              class="form-holder"
              @submit="submitLogin">
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
              <p class="forgot-pass mt-10 text-[var(--color-primary-100)] mb-5">Forgot Password?</p>
              <PrimaryButton type="submit" class="submit-btn">LOGIN</PrimaryButton>
            </form>
         
          </div>
          </div>
  </div>
  
</template>
<style scoped>
.formwarp {
  height: 100vh;
  overflow-x: auto;
  background-image: url(/Users/dev/Desktop/nlmaf-breeze/public/assets/images/formbg.webp);
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
}
.login-register {
  height: 100%;
  display: flex;
}
.form {
  background-color: var(--color-primary-500);
  opacity: 0.8;
  width: 450px;
  margin: auto;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 0 15px 2px var(--color-secondary-500);
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
  color: var(--color-primary-100);
}
.form input {
  width: 100%;
  padding: 10px;
  border: 0;
  border-radius: 3px;
  color: var(--color-primary-900);
}
.form input:focus {
  outline: none;
  box-shadow: 0 0 10px var(--color-secondary-500);
}
.form-bottom {
  margin-top: 20px;
}
.form-bottom p {
  margin: 5px 0;
  color: var(--color-primary-100);
}
.form-bottom a {
  color: var(--color-primary-100);
  font-weight: bold;
  text-decoration: none;
}
 #forgot-password, #register {
  display: none;
}
  </style>
