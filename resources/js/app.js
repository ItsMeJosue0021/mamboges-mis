import './bootstrap';
import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import 'boxicons';
import jQuery from 'jquery';

window.$ = jQuery;

window.Alpine = Alpine;
Alpine.start();

AOS.init({
    offset: 150,
    duration: 1400
});

