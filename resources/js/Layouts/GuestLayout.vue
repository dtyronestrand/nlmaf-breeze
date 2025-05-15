<template>

    <main>
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
.content {
    max-width: 1200px;
    margin: 100px auto 0;
    padding: 0 20px;
    text-align: center;
}

.content h1 {
    margin-bottom: 20px;
    color: #333;
}

/* Navbar Styles */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: var(--color-primary-500);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem;
    height: 70px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

/* Logo Styles */
.logo a {
    color: var(--color-text-primary);
    font-size: 1.5rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
}

.logo a:hover {
    color: var(--color-focus);
}

/* Navigation Menu Styles */
.nav-links {
    display: flex;
    list-style: none;
}

.nav-links li {
    margin-left: 2rem;
}

.nav-links a {
    color: #ecf0f1;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 500;
    padding: 0.5rem 0;
    transition: all 0.3s ease;
    position: relative;
}

.nav-links a:hover {
    color: #3498db;
}

/* Active link indicator */
.nav-links a.active {
    color: #3498db;
}

.nav-links a.active::after {
    content: "";
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #3498db;
}

/* Hamburger Menu */
.hamburger {
    display: none;
    cursor: pointer;
}

.bar {
    display: block;
    width: 25px;
    height: 3px;
    margin: 5px auto;
    background-color: white;
    transition: all 0.3s ease;
}

/* Mobile Responsive Styles */
@media only screen and (max-width: 768px) {
    /* Show hamburger menu on mobile */
    .hamburger {
        display: block;
    }

    /* Animate hamburger to X when menu is active */
    .hamburger.active .bar:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    .hamburger.active .bar:nth-child(2) {
        opacity: 0;
    }

    .hamburger.active .bar:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }

    /* Position the nav menu for mobile */
    .nav-menu {
        position: fixed;
        top: 70px; /* Height of the navbar */
        left: -100%;
        width: 100%;
        background-color: #2c3e50;
        text-align: center;
        transition: 0.3s;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
    }

    /* Show nav menu when active class is added */
    .nav-menu.active {
        left: 0;
    }

    /* Stack nav links vertically */
    .nav-links {
        flex-direction: column;
        padding: 20px 0;
    }

    .nav-links li {
        margin: 10px 0;
    }
}
</style>
