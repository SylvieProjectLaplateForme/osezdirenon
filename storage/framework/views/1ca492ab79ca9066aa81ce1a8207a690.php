<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Osez Dire Non'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
     <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>

</head>
<body class="bg-pink-50 text-gray-800 font-sans">

<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        
        <a href="<?php echo e(route('home')); ?>" class="text-2xl font-serif font-bold text-pink-600 whitespace-nowrap">
            Osez Dire Non
        </a>
        
        <div class="md:hidden">
            <button id="menu-btn" class="text-pink-600 text-3xl focus:outline-none">☰</button>
        </div>

        
        <nav class="hidden md:flex space-x-4 text-sm items-center font-medium">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-pink-600">Accueil</a>
            <a href="<?php echo e(route('contact')); ?>" class="hover:text-pink-600">Contact</a>

            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="hover:text-pink-600">Connexion</a>
                <a href="<?php echo e(route('register')); ?>" class="hover:text-pink-600">Inscription</a>
            <?php else: ?>
                <span class="text-pink-600 font-semibold">
                    Bonjour, <?php echo e(Auth::user()->name); ?>

                    <?php if(Auth::user()->role): ?>
                        <span class="text-xs text-gray-500">(<?php echo e(Auth::user()->role->name); ?>)</span>
                    <?php endif; ?>
                </span>

                <?php $role = Auth::user()->role->name ?? null; ?>
                <?php if($role === 'admin'): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-pink-600">Dashboard Admin</a>
                <?php elseif($role === 'editeur'): ?>
                    <a href="<?php echo e(route('editeur.dashboard')); ?>" class="hover:text-pink-600">Mon Espace</a>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-red-600 hover:underline">Déconnexion</button>
                </form>
            <?php endif; ?>
        </nav>
    </div>

    
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2 text-sm font-medium">
        <a href="<?php echo e(route('home')); ?>" class="block hover:text-pink-600">Accueil</a>
        <a href="<?php echo e(route('contact')); ?>" class="block hover:text-pink-600">Contact</a>

        <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('login')); ?>" class="block hover:text-pink-600">Connexion</a>
            <a href="<?php echo e(route('register')); ?>" class="block hover:text-pink-600">Inscription</a>
        <?php else: ?>
            <div class="text-pink-600 font-semibold">
                Bonjour, <?php echo e(Auth::user()->name); ?>

                <?php if(Auth::user()->role): ?>
                    <span class="text-xs text-gray-500">(<?php echo e(Auth::user()->role->name); ?>)</span>
                <?php endif; ?>
            </div>

            <?php if($role === 'admin'): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block hover:text-pink-600">Dashboard Admin</a>
            <?php elseif($role === 'editeur'): ?>
                <a href="<?php echo e(route('editeur.dashboard')); ?>" class="block hover:text-pink-600">Mon Espace</a>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="text-red-600 hover:underline">Déconnexion</button>
            </form>
        <?php endif; ?>
    </div>
</header>


<main class="max-w-7xl mx-auto py-10 px-4">
    <?php echo $__env->yieldContent('content'); ?>
</main>


<footer class="bg-white border-t mt-10">
    <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm text-pink-600 font-semibold">
        © <?php echo e(date('Y')); ?> Osez Dire Non — Le blog qui vous donne la parole.
        <div class="flex justify-center gap-4">
            <a href="<?php echo e(route('apropos')); ?>" class="hover:text-gray-600">À propos</a>
            <a href="<?php echo e(route('cgu')); ?>" class="hover:text-gray-600">Conditions Générales</a>
            <a href="<?php echo e(route('confidentialite')); ?>" class="hover:text-gray-600">Confidentialité</a>
            <a href="<?php echo e(route('plan')); ?>" class="hover:text-gray-600">Plan du site</a>
        </div>
        
    </div>
</footer>


<script>
    document.getElementById('menu-btn').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>



</div>


<!-- 🔒 Bandeau RGPD responsive -->
<div id="cookieConsentBox"
     class="fixed bottom-12 left-1/2 transform -translate-x-1/2 bg-black text-white border border-gray-700 shadow-2xl rounded-xl w-[95%] max-w-3xl z-50 p-6 md:p-8 text-center md:text-left space-y-4">

    <h3 class="text-lg md:text-xl font-bold">🍪 Confidentialité & Cookies</h3>

    <p class="text-sm md:text-base leading-relaxed">
        Ce site utilise des cookies pour améliorer votre expérience. En poursuivant votre navigation, vous acceptez notre
        <a href="<?php echo e(route('confidentialite')); ?>" class="text-pink-500 underline hover:text-pink-400">
            politique de confidentialité
        </a>.
    </p>

    <div class="flex flex-col sm:flex-row justify-center md:justify-end gap-3">
        <button id="acceptCookies"
                class="bg-pink-600 text-white text-sm px-6 py-2 rounded hover:bg-pink-700 transition">
            J'accepte
        </button>
        <button id="rejectCookies"
                class="bg-white text-black text-sm px-6 py-2 rounded hover:bg-gray-200 transition">
            Je refuse
        </button>
    </div>
</div>

<!-- 🧠 Script RGPD -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const banner = document.getElementById('cookieConsentBox');
        const acceptBtn = document.getElementById('acceptCookies');
        const rejectBtn = document.getElementById('rejectCookies');

        if (localStorage.getItem('cookieConsent') === 'accepted' || localStorage.getItem('cookieConsent') === 'rejected') {
            banner.style.display = 'none';
        }

        const handleConsent = (value) => {
            localStorage.setItem('cookieConsent', value);
            banner.style.display = 'none';
        };

        acceptBtn?.addEventListener('click', () => handleConsent('accepted'));
        rejectBtn?.addEventListener('click', () => handleConsent('rejected'));
    });
</script>
<?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/layout.blade.php ENDPATH**/ ?>