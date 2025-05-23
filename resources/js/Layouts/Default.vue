<template>
   <header class=" bg-[var(--color-primary-800)] border-b border-[var(--color-accent-500)]">
    <nav class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <Link href="/" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap text-[var(--color-text-primary)]">NLMAF</span>
        </Link>

        <!-- Right-aligned items group (Download, Login/Logout, Mobile Hamburger) -->
        <div class="flex items-center md:order-2">
            <div class="hidden m-2 mr-4 sm:inline-block"> <!-- This span's purpose is unclear, might be for spacing or a placeholder -->
                <span></span>
            </div>
            <a href="https://themesberg.com/product/tailwind-css/landing-page"
                class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-md text-sm px-4 md:px-5 py-2 md:py-2.5 sm:mr-2 md:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Download</a>
            
            <div v-if="$page.props.user" class="ml-2 sm:mr-2"> <!-- Adjusted margins for consistency -->
                <SecondaryButton @click="handleLogout">Logout</SecondaryButton>
            </div>
            <div v-else class="ml-2 sm:mr-2"> <!-- Adjusted margins for consistency -->
                <SecondaryButton @click="handleLogin">Login</SecondaryButton>
            </div>

            <!-- Mobile Menu Hamburger Button -->
          <button type="button"
    @click="toggleMobileMenu"
    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-md md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
    :aria-expanded="isMobileMenuOpen.toString()"
    aria-controls="main-menu-content">
                <span class="sr-only">Open main menu</span>
                <svg v-if="!isMobileMenuOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg  v-if="isMobileMenuOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <!-- The md:hidden hamburger button was here, it's removed as it seems redundant -->
        </div>

        <!-- Collapsible Menu Links -->
<div id="main-menu-content"
     :class="{ 'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }"
     class="items-center justify-between w-full md:flex md:w-auto md:order-1">
            <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-8 md:mt-0">
                <li v-for="link in $page.props.menuLinks" :class="link.submenu ? 'has-dropdown' : ''" :key="link.id">
                    <Link v-if="!link.submenu" :href="link.url"
                        class="block py-2 pl-3 pr-4 rounded md:bg-transparent bg-[var(--color-primary-600)] md:p-0 text-[var(--color-text-primary)] transition hover:text-[var(--color-secondary-500)]"
                        aria-current="page">{{ link.title }}</Link>
                    <span v-else>
                        <Link :href="link.url"
                            class="block py-2 pl-3 pr-4 rounded md:bg-transparent bg-[var(--color-primary-600)] md:p-0 text-[var(--color-text-primary)] transition hover:text-[var(--color-secondary-500)]">
                        {{ link.title }} <svg class="icon chevron-icon" viewBox="0 0 24 24" width="14" height="14">
                            <path d="M7 10l5 5 5-5z" fill="currentColor"></path>
                        </svg>
                        </Link>
                        <ul class="dropdown">
                            <li v-for="sub in link.submenu" :key="sub.id">
                                <Link :href="sub.url">{{ sub.title }}</Link>
                            </li>
                        </ul>
                    </span>
                </li>
            </ul>
        </div>
    </nav>
   </header>
    <main class="-mt-20 relative pb-8">
        <slot></slot>
    </main>
    <footer class="hidden  bg-[var(--nav-bg)] md:grid md:grid-cols-5 mt-20 w-full border-t border-[var(--border-color)]">
    <!-- Image Section -->
    <div class="flex justify-center items-center py-8 md:col-span-2 md:py-16 md:pl-4 md:justify-start">
        <img src="http://localhost:8000/img/9b0fd4e7-c2f7-485b-a09b-e9078080a064/z2sbzpbqstj980jj-nlmaf-logo-2shues-smallcropped.jpeg?fm=jpg&q=80&fit=max&crop=2048%2C2048%2C0%2C0" 
             alt="No Limits Martial Arts and Fitness" 
             class="rounded-full h-[10rem] w-[10rem] object-cover">
    </div>
    <!-- Content Section -->
    <div class=" pt-0 pb-8 sm:px-6 md:col-span-3 md:px-2 md:py-16">
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
    <div>
    <p>
    <span class="text-2xl tracking-wide text-[var(--color-text-primary)] uppercae">Contact Us</span>
    <span class="block text-xl font-medium text-[var(--color-text-primary)]">804-867-5309</span>
    <PrimaryButton @click="contact">Leave a Message</PrimaryButton>
    </p>

    </div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
    <p class="font-medium text-[var(--color-text-primary)]">Navigation</p>
    <ul class="mt-6 space-y-4 text-sm">
    <li v-for="link in $page.props.menuLinks" :key="link.id">
    <Link :href="link.url" class="text-[var(--color-text-primary)] hover:text-[var(--color-text-secondary)]">{{ link.title }}</Link>
    </li>
    </ul>
    </div>
    </div>
    </div>
    </div>
    </footer>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import IconButton from "@/Components/Theme/UI/IconButton.vue";
import {router} from "@inertiajs/vue3";
const form = useForm();
const handleLogout = ()=>{
    router.post(route('logout'));
}
const handleLogin  = ()=>{
    router.visit(route('register'))
}



// Reactive state for mobile menu visibility
const isMobileMenuOpen = ref(false); // Initially closed

// Method to toggle the menu state
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

</script>
<style scoped>

/* Reset some default browser styles */


/* Basic content styling for demo */


/* Header and Navbar */

/* Icons */
.icon {
    transition: var(--transition-medium);
    vertical-align: middle;
}

.chevron-icon {
    transition: transform var(--transition-medium);
}

.has-dropdown:hover .chevron-icon {
    transform: rotate(180deg);
}



/* Dropdown Menus */
.has-dropdown {
    position: relative;
}

.dropdown {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    min-width: 220px;
    background: var(--dropdown-bg);
    backdrop-filter: var(--glass-effect);
    -webkit-backdrop-filter: var(--glass-effect);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: 0.5rem;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px) scale(0.98);
    transition: all var(--transition-medium);
    box-shadow: 0 10px 30px var(--shadow-color);
    z-index: 100;
}

.has-dropdown:hover .dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.dropdown::before {
    content: '';
    position: absolute;
    top: -6px;
    left: 20px;
    width: 12px;
    height: 12px;
    background: var(--dropdown-bg);
    border-left: 1px solid var(--border-color);
    border-top: 1px solid var(--border-color);
    transform: rotate(45deg);
    backdrop-filter: var(--glass-effect);
    -webkit-backdrop-filter: var(--glass-effect);
}

.dropdown li {
    list-style: none;
}

.dropdown a {
    color: var(--text-color);
    text-decoration: none;
    padding: 0.7rem 1rem;
    display: block;
    border-radius: var(--border-radius);
    transition: all var(--transition-medium);
    margin-bottom: 2px;
}

.dropdown a:hover {
    background: rgba(244, 208, 63, 0.15);
    color: var(--primary-color);
    transform: translateX(5px);
}

</style>
