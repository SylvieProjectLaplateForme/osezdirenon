@if ($publicites->count())
<section aria-labelledby="pubs-heading">
    <h2 class="text-center text-lg font-bold text-pink-600 mb-6">
        💗 Publicités partenaires
        <span class="relative group ml-2 inline-block">
            <svg class="w-4 h-4 text-pink-400 inline" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 7h2v2H9V7zm1-5a9 9 0 100 18A9 9 0 0010 2zm0 16a7 7 0 110-14 7 7 0 010 14z" />
            </svg>
            <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-56 px-3 py-2 text-white bg-pink-600 text-xs rounded shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-50 text-center">
                Publicités validées et payées<br>
                @auth
                    <a href="{{ route('editeur.publicites.create') }}" class="underline text-pink-200 hover:text-white">
                        Créer la vôtre 💖
                    </a>
                @else
                    <a href="{{ route('login', ['message' => 'connect_pub', 'redirect' => route('editeur.publicites.create')]) }}"
                       class="underline text-pink-200 hover:text-white">
                        Créer la vôtre 💖
                    </a>
                @endauth
            </span>
        </span>
    </h2>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        @foreach ($publicites as $pub)
            <div class="swiper-slide h-full">
                <a href="{{ $pub->lien }}" target="_blank"
                   aria-label="Visiter la publicité : {{ $pub->titre }}"
                   class="flex flex-col justify-between h-full p-4 bg-pink-100 hover:bg-pink-200 rounded-xl shadow text-center">

                    @if ($pub->image)
                        <img src="{{ asset('storage/' . $pub->image) }}"
                             alt="{{ $pub->titre }}"
                             class="h-32 mx-auto object-contain mb-4">
                    @endif

                    {{-- Bloc texte avec hauteur fixe pour uniformité --}}
                    <div class="min-h-[3.5rem] flex items-center justify-center">
                        <h3 class="text-pink-700 font-semibold text-sm leading-snug">
                            {{ $pub->titre }}
                        </h3>
                    </div>

                    <p class="text-pink-600 font-bold mt-3">Visiter →</p>
                </a>
            </div>
        @endforeach
    </div>

    <div class="swiper-button-prev text-pink-600 hover:text-pink-800"></div>
    <div class="swiper-button-next text-pink-600 hover:text-pink-800"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 16,
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
    });
</script>
@endif
