<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'OSEZ DIRE NON') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">

    <!-- Contenu de la page -->
    <div class="min-h-screen">
        @include('layouts.navigation')

        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- 🔒 Bandeau RGPD -->
    <div id="cookie-banner" class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-300 p-4 shadow-lg flex flex-col sm:flex-row items-center justify-between gap-4 hidden">
        <p class="text-sm text-gray-700 text-center sm:text-left">
            En poursuivant votre navigation, vous pouvez accepter ou refuser notre 
            <a href="{{ route('confidentialite') }}" class="text-blue-600 hover:underline">politique de confidentialité</a> et nos 
            <a href="{{ route('cgu') }}" class="text-blue-600 hover:underline">conditions d’utilisation</a>.
        </p>
        <div class="flex gap-2">
            <button id="accept-cookies" class="bg-blue-600 text-white px-4 py-2 text-sm rounded hover:bg-blue-700 transition">
                J'accepte
            </button>
            <button id="refuse-cookies" class="bg-gray-300 text-gray-800 px-4 py-2 text-sm rounded hover:bg-gray-400 transition">
                Je refuse
            </button>
        </div>
    </div>

    <!-- 🧠 Script RGPD -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const banner = document.getElementById("cookie-banner");
            const acceptBtn = document.getElementById("accept-cookies");
            const refuseBtn = document.getElementById("refuse-cookies");

            if (!banner || !acceptBtn || !refuseBtn) {
                console.error("❌ Les éléments RGPD ne sont pas trouvés.");
                return;
            }

            const userChoice = localStorage.getItem("rgpdChoice");

            if (!userChoice) {
                banner.classList.remove("hidden");
            }

            acceptBtn.addEventListener("click", function () {
                localStorage.setItem("rgpdChoice", "accepted");
                banner.classList.add("hidden");
                console.log("✅ Consentement accepté");
            });

            refuseBtn.addEventListener("click", function () {
                localStorage.setItem("rgpdChoice", "refused");
                banner.classList.add("hidden");
                console.log("❌ Consentement refusé");
            });
        });
    </script>
</body>
</html>
