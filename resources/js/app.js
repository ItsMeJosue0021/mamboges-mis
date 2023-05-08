import './bootstrap';

import Alpine from 'alpinejs';

import AOS from 'aos';

import 'aos/dist/aos.css';

import 'boxicons';

window.Alpine = Alpine;

Alpine.start();

// Initialize AOS
AOS.init({
    offset: 150,
    duration: 1400
});

