<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Swiper Horizontal</title>
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
            background: #fff5fa;
        }
        .swiper {
            width: 100%;
            padding: 40px 0;
        }
        .swiper-slide {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px #ddd;
            padding: 30px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2 style="text-align:center; color:#d63384;">💗 Publicités partenaires</h2>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">Publicité 1</div>
        <div class="swiper-slide">Publicité 2</div>
        <div class="swiper-slide">Publicité 3</div>
        <div class="swiper-slide">Publicité 4</div>
        <div class="swiper-slide">Publicité 5</div>
    </div>

    <!-- Flèches -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>
</div>

<script>
    const swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        }
    });
</script>

</body>
</html>
<?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/test-swiper.blade.php ENDPATH**/ ?>