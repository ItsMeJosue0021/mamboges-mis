import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.js',
        './public/js/*.js',
        './resources/views/**/*.blade.php',
        './resources/css/*.css',

    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            backgroundImage: {
                // 'school': "url('/image/school-blur.png')",
                // 'mambog-classes': "url('/image/mamboges2.png')",
                // 'deped': "url('/image/deped.png')",
                // 'mambog': "url('/image/mamboges.jpg')",
                'mambog-2': "url('image/bg-mambog.jpg')",
            },

            screens: {
                'phone': '350px',
                'tablet': '640px',
                'tablet+': '850px',
                'laptop': '1024px',
                'desktop': '1280px',
            },
            colors: {
                // red: '#d90429',
                // blue: '#004e89',
                lightgray: '#EFF0F3',
                yellow: '#FBE830',
                black: '#212529',
                lightblack: '#343a40',
                youtube: '#FF0000',
                lightestgray: '#6c757d',
                whitegray: '#e9ecef',
                white2: '#f8f9fa'
            },
            margin: {
                '250px': '250px',
                
            },
            width: {
                '60px': '60px',
                '250px': '400px',
                '500px': '500px',
                '200px': '200px',
                '300px': '300px',
                '400px': '400px',
                '700px': '700px',
                '300px': '300px',
                '250px': '250px',
                '48px': '48px',
            },
            height: {
                '48px': '48px',
                '60px': '60px',
                '560px': '560px',
                '565px': '565px',
                '570px': '570px',
                '580px': '580px',
                '585px': '585px',
                '595px': '595px',
                '600px': '600px',
                '700px': '670px',
                '400px': '400px',
                '390px': '390px',
                '500px': '500px',
                '200px': '200px',
                '250px': '250px',
                '300px': '300px',
            },
            minHeight: {
                '600px': '600px',
                '900px': '900px',
                '250px': '250px',
            },
            minWidth: {
                '250px': '250px',
                '900px': '900px',
            },
            fontSize: {
                
            },
            boxShadow: {
                'EmailForm': '0px 0px 6px 0px rgba(0,0,0,0.2)',
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('daisyui'),
        forms
    ],

};
