import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import animate from 'tailwindcss-animate';
import {setupInspiraUI} from '@inspira-ui/plugins'
/** @type {import('tailwindcss').Config} */
export default {
    prefix: "",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    
          
    plugins: [forms, animate, setupInspiraUI],
};
