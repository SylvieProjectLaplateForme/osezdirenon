

<?php $__env->startSection('title', 'Plan du site'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-pink-50 border border-pink-200 p-6 rounded-lg mb-10 shadow">
    <p class="mb-4 text-gray-700 leading-relaxed">
        Bienvenue sur le plan du site <strong>"Osez Dire Non"</strong> 🌐
    </p>

    <p class="mb-4 text-gray-700 leading-relaxed">
        Que vous soyez visiteur, lecteur fidèle ou membre connecté, cette page est là pour vous guider facilement à travers toutes les rubriques disponibles sur notre plateforme.
    </p>

    <ul class="list-disc list-inside text-gray-800 space-y-1">
        <li>📖 Découvrez les <strong>derniers articles publiés</strong> selon vos centres d’intérêt</li>
        <li>🔍 Accédez rapidement aux sections utiles : <em>accueil</em>, <em>contact</em>, <em>mentions légales</em>, etc.</li>
        <li>🧑‍💻 Pour les membres connectés, retrouvez vos <strong>publications</strong>, <strong>commentaires</strong> ou <strong>publicités</strong> personnelles</li>
        
    </ul>

        <p class="mt-4 text-gray-700">
            👉 <strong>Utilisez les liens ci-dessous</strong> pour vous orienter plus rapidement et explorer tout le potentiel du site.
        </p>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 text-sm text-gray-700">

        
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">🏠 Navigation</h2>
            <ul class="space-y-1">
                <li><a href="<?php echo e(route('home')); ?>" class="hover:underline">Accueil</a></li>
                <li><a href="<?php echo e(route('contact')); ?>" class="hover:underline">Contact</a></li>
                <li><a href="<?php echo e(route('publicites.publiques')); ?>" class="hover:underline">Publicités</a></li>
            </ul>
        </div>

        
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">👤 Mon compte</h2>
            <ul class="space-y-1">
                <?php if(auth()->guard()->check()): ?>
                    <li><a href="<?php echo e(route('editeur.dashboard')); ?>" class="hover:underline">Dashboard éditeur</a></li>
                    <li><a href="<?php echo e(route('logout')); ?>" class="hover:underline">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="<?php echo e(route('login')); ?>" class="hover:underline">Connexion</a></li>
                    <li><a href="<?php echo e(route('register')); ?>" class="hover:underline">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </div>

        
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">📢 Publicités</h2>
            <ul class="space-y-1">
                <li><a href="<?php echo e(route('editeur.publicites.create')); ?>" class="hover:underline">Créer une publicité</a></li>
                <li><a href="<?php echo e(route('editeur.publicites.index')); ?>" class="hover:underline">Mes publicités</a></li>
                <li><a href="<?php echo e(route('editeur.publicites.payees')); ?>" class="hover:underline">Publicités payées</a></li>
            </ul>
        </div>

        
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">⚙️ Profil</h2>
            <ul class="space-y-1">
                <li><a href="<?php echo e(route('editeur.profile.edit')); ?>" class="hover:underline">Modifier mon profil</a></li>
            </ul>
        </div>

        
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">⚖️ Légal</h2>
            <ul class="space-y-1">
                <li><a href="<?php echo e(route('apropos')); ?>" class="hover:underline">À propos</a></li>
                <li><a href="<?php echo e(route('cgu')); ?>" class="hover:underline">CGU</a></li>
                <li><a href="<?php echo e(route('confidentialite')); ?>" class="hover:underline">Confidentialité</a></li>
                <li><a href="<?php echo e(route('plan')); ?>" class="hover:underline font-semibold text-pink-600">Plan du site</a></li>
            </ul>
        </div>

        
        <?php if(Auth::check() && Auth::user()->role === 'admin'): ?>
        <div>
            <h2 class="text-pink-600 font-semibold text-lg mb-3">🛠️ Admin</h2>
            <ul class="space-y-1">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:underline">Dashboard Admin</a></li>
                <li><a href="<?php echo e(route('admin.articles.index')); ?>" class="hover:underline">Gérer les articles</a></li>
                <li><a href="<?php echo e(route('admin.publicites.index')); ?>" class="hover:underline">Gérer les publicités</a></li>
                <li><a href="<?php echo e(route('admin.editeurs.index')); ?>" class="hover:underline">Liste des éditeurs</a></li>
                <li><a href="<?php echo e(route('admin.comments.pending')); ?>" class="hover:underline">Commentaires en attente</a></li>
                <li><a href="<?php echo e(route('admin.profil.index')); ?>" class="hover:underline">Mon profil admin</a></li>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/planSite.blade.php ENDPATH**/ ?>