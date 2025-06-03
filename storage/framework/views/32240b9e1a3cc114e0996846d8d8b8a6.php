<?php $__env->startSection('title', 'Dashboard Éditeur'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 shadow">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Bienvenue, <?php echo e(Auth::user()->name); ?></h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Mes articles</h2>
        <p class="text-2xl font-bold"><?php echo e($totalArticles ?? 0); ?></p>
        <a href="<?php echo e(route('editeur.articles.index')); ?>" class="text-blue-500 hover:underline">Voir </a>
    </div>

    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Articles en attente</h2>
        <p class="text-2xl font-bold"><?php echo e($attenteArticles ?? 0); ?></p>
        <a href="<?php echo e(route('editeur.articles.enAttente')); ?>" class="text-blue-500 hover:underline">Voir </a>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Mes Publicités </h2>
        <p class="text-2xl font-bold"><?php echo e($totalPublicites ?? 0); ?></p>
        <a href="<?php echo e(route('editeur.publicites.index')); ?>" class="text-blue-500 hover:underline">Voir </a>
    </div>

    <div class="bg-white rounded shadow p-4 text-center">
    <h3 class="text-lg font-semibold">À Payer</h3>
    <p class="text-2xl font-bold"><?php echo e($pubsAPayer); ?></p>
    <a href="<?php echo e(route('editeur.publicites.a_payer')); ?>" class="text-blue-500 hover:underline ">
        Voir
    </a>
</div>
    
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Mes paiements</h2>
        <p class="text-2xl font-bold"><?php echo e($totalPaiements ?? 0); ?></p>
        <a href="<?php echo e(route('editeur.paiements.index')); ?>" class="text-blue-500 hover:underline">Voir </a>
    </div>
</div>


<div class="bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Derniers articles</h2>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="text-left px-4 py-2 border-b">Titre</th>
                <th class="text-left px-4 py-2 border-b">Statut</th>
                <th class="text-left px-4 py-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-4 py-2 border-t"><?php echo e($article->title); ?></td>
                    <td class="px-4 py-2 border-t">
                        <?php if($article->is_approved): ?>
                            <span class="text-green-600">✔ Validé</span>
                        <?php else: ?>
                            <span class="text-yellow-600">⏳ En attente</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2 border-t">
                        <a href="<?php echo e(route('article.show', $article->slug)); ?>" class="text-blue-600 hover:underline">Voir</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">Aucun article pour le moment.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/dashboard.blade.php ENDPATH**/ ?>