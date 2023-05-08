const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'school': "url('image/school-blur.png')",
                'deped': "url('images/deped.png')",
                'mambog': "url('image/mamboges.jpg')",
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('daisyui')
    ],

};
