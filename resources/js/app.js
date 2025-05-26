import './bootstrap';
import Alpine from 'alpinejs';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';



window.Alpine = Alpine;
Alpine.start();



document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.multiple-slide-carousel', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        }
    });
});
console.log("✅ app.js chargé !");
console.log("Swiper :", typeof Swiper); // doit dire function
