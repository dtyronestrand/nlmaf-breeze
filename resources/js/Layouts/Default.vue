<template>
   <header class="header">
   <nav class="navbar">
   <div class="nav-brand">
   <Link href="/" class="logo">NLMAF</Link>
   </div>
   <div class="nav-toggle">
   <div class="hamburger">
   <span></span>
<span></span>
<span></span>
   </div>
   </div>
<div class="nav-menu">
<ul class="nav-list" v-for="link in $page.props.menuLinks">
<li  v-if="!link.submenu" >
   <Link :href="link.url" class="nav-link" >{{ link.title }}</Link>
</li>
<li v-else class="nav-item has-dropdown">
<Link :href="link.url" class="nav-link">
{{ link.title }}              <svg class="icon chevron-icon" viewBox="0 0 24 24" width="14" height="14">
                                <path d="M7 10l5 5 5-5z" fill="currentColor"></path>
                            </svg>
</Link>
<ul class="dropdown">
<li v-for="sub in link.submenu" :key="sub.id">
<Link :href="sub.url">{{ sub.title }}</Link>
</li>
</ul>
</li>
</ul>
</div>
   </nav>
   </header>
    <main class="mt-[70px]">
        <slot></slot>
    </main>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm();
const handleLogout = ()=>{
    form.post(route('logout'));
}

</script>
<style scoped>

/* Reset some default browser styles */


/* Basic content styling for demo */


/* Header and Navbar */
.header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
}

.navbar {
    display: flex;
justify-content: space-between;
    align-items: center;
    padding: 1rem 4rem;
    background: var(--nav-bg);
    backdrop-filter: var(--glass-effect);
    -webkit-backdrop-filter: var(--glass-effect);
    border-bottom: 1px solid var(--border-color);
    box-shadow: 0 4px 30px var(--shadow-color);
    transition: var(--transition-medium);
}

/* Logo */
.logo {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: var(--neon-glow);
    position: relative;
    display: inline-block;
    transition: var(--transition-medium);
   
}

.logo:hover {
    transform: translateY(-2px);
    text-shadow: 0 0 15px var(--primary-glow),
                 0 0 30px var(--primary-glow);
}

.logo::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    background: var(--primary-color);
    bottom: -4px;
    left: 0;
    transform: scaleX(0);
    transform-origin: right;
    transition: transform var(--transition-medium);
    box-shadow: var(--neon-glow);
}

.logo:hover::after {
    transform: scaleX(1);
    transform-origin: left;
}

/* Navigation Menu */
.nav-menu {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-list {
    display: flex;
    gap: 1.5rem;
    list-style: none;
}

.nav-item {
    position: relative;
}

.nav-link {
    color: var(--text-color);
    text-decoration: none;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius);
    transition: all var(--transition-medium);
    display: flex;
    align-items: center;
    gap: 5px;
}

.nav-link:hover,
.nav-link.active {
    color: var(--primary-color);
    text-shadow: var(--neon-glow);
    background: rgba(255, 255, 255, 0.05);
    transform: translateY(-2px);
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 5px;
    height: 5px;
    background-color: var(--primary-color);
    border-radius: 50%;
    box-shadow: var(--neon-glow);
}
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

.hidden {
    display: none;
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
    background: rgba(33, 150, 243, 0.15);
    color: var(--primary-color);
    transform: translateX(5px);
}
</style>
