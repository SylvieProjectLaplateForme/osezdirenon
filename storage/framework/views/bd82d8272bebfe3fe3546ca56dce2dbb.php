<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo $__env->yieldContent('title'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-100">
    <?php echo $__env->yieldPushContent('scripts'); ?>

    
    <div class="md:hidden p-4 bg-white shadow flex justify-between items-center">
        <span class="text-lg font-bold">Tableau de bord <?php echo e(Auth::user()->name); ?></span>
        <button id="burgerBtn" aria-label="Ouvrir le menu" class="text-gray-700 focus:outline-none">
            ☰
        </button>
    </div>

    
    <div class="flex min-h-screen">

        
        <aside id="sidebar" class="bg-gray-900 text-white w-64 p-6 space-y-4 fixed md:relative md:block hidden z-50 h-full">

            <div class="flex justify-between items-center md:block">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-xl font-bold mb-6 hidden md:block hover:underline">
    🏠Tableau de bord de <?php echo e(Auth::user()->name); ?>

                <button class="md:hidden text-white" onclick="document.getElementById('sidebar').classList.add('hidden')">✕</button>
            </div>

            
            <a href="<?php echo e(route('admin.profil.index')); ?>" class="block py-2 pl-4 hover:bg-gray-800 rounded">👤 Mon profil</a>

            
            <div>
                <h3 class="uppercase text-gray-400 text-xs mb-2">Articles</h3>
                <a href="<?php echo e(route('admin.articles.index')); ?>" class="<?php echo e(request()->routeIs('admin.articles.index') ? 'bg-gray-800' : ''); ?> block py-2 pl-4 hover:bg-gray-800 rounded">🗂 Tous les articles</a>
                <a href="<?php echo e(route('admin.articles.valides')); ?>" class="<?php echo e(request()->routeIs('admin.articles.valides') ? 'bg-gray-800' : ''); ?> block py-2 pl-8 hover:bg-gray-800 rounded">✔ Validés</a>
                <a href="<?php echo e(route('admin.articles.attente')); ?>" class="<?php echo e(request()->routeIs('admin.articles.attente') ? 'bg-gray-800' : ''); ?> block py-2 pl-8 hover:bg-gray-800 rounded">⏳ En attente</a>
                <a href="<?php echo e(route('admin.articles.create')); ?>" class="<?php echo e(request()->routeIs('admin.articles.create') ? 'bg-gray-800' : ''); ?> block py-2 pl-4 hover:bg-gray-800 rounded">✍️ Créer un article</a>
                <!-- Lien vers mes articles -->
                <a href="<?php echo e(route('admin.articles.mes')); ?>" class="<?php echo e(request()->routeIs('admin.articles.mes') ? 'bg-gray-800' : ''); ?> block py-2 pl-4 hover:bg-gray-800 rounded"> 📝 Mes articles
                </a>
    

                <a href="<?php echo e(route('admin.commentaires.index')); ?>" class="block py-2 pl-4 hover:bg-gray-800 rounded">🗨️ <span class="ml-2">Tous les commentaires</span>
                 </a>

            </div>

            
            <div>
                <h3 class="uppercase text-gray-400 text-xs mb-2">Publicités</h3>
                <a href="<?php echo e(route('admin.publicites.index')); ?>" class="<?php echo e(request()->routeIs('admin.publicites.index') ? 'bg-gray-800' : ''); ?> block py-2 pl-4 hover:bg-gray-800 rounded">🗂Toutes les publicités</a>
                <a href="<?php echo e(route('admin.publicites.attente')); ?>" class="<?php echo e(request()->routeIs('admin.publicites.attente') ? 'bg-gray-800' : ''); ?> block py-2 pl-8 hover:bg-gray-800 rounded">⏳ En attente</a>
            </div>

            
<div>
    <h3 class="uppercase text-gray-400 text-xs mb-2">Paiements</h3>
    <a href="<?php echo e(route('admin.paiements.stats')); ?>"
       class="<?php echo e(request()->routeIs('admin.paiements.stats') ? 'bg-gray-800' : ''); ?> block py-2 pl-4 hover:bg-gray-800 rounded">
        💶 Statistiques des paiements
    </a>
</div>



            
            <div>
                <h3 class="uppercase text-gray-400 text-xs mb-2">Éditeurs</h3>
                <a href="<?php echo e(route('admin.editeurs.index')); ?>" class="block py-2 pl-4 hover:bg-gray-800 rounded">Liste des éditeurs</a>
            </div>

            
            <div class="pt-6 space-y-2">
                <a href="<?php echo e(route('home')); ?>" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">
                    ⬅ Retour à l'accueil 
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="text-center">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="mt-2 text-sm text-gray-300 hover:text-white">🚪 Déconnexion</button>
                </form>
            </div>
        </aside>

        
        <main class="flex-1 md:ml-34 p-6 bg-gray-100 min-h-screen">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>

    
    <script>
        const burger = document.getElementById('burgerBtn');
        const sidebar = document.getElementById('sidebar');

        burger.addEventListener('click', () => {
            sidebar.classList.remove('hidden');
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.form-delete');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                const confirmation = confirm('⚠️ Voulez-vous vraiment supprimer cet article ? Cette action est irréversible.');
                if (!confirmation) {
                    e.preventDefault(); // Stoppe l’envoi du formulaire
                }
            });
        });
    });
</script>

    

</body>
</html>
<?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/layout.blade.php ENDPATH**/ ?>