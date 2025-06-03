

<?php $__env->startSection('title', 'Mes articles en attente'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">🕓 Articles en attente de validation</h1>

    <?php if($articlesEnAttente->isEmpty()): ?>
        <p class="text-gray-600">Vous n'avez aucun article en attente.</p>
    <?php else: ?>

        
        <div class="space-y-4 md:hidden">
    <?php $__currentLoopData = $articlesEnAttente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-yellow-50 border border-yellow-200 shadow rounded p-4 text-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-1"><?php echo e($article->title); ?></h2>
            <p class="text-gray-600 mb-2">Créé le : <?php echo e($article->created_at->format('d/m/Y')); ?></p>
            <div class="flex flex-wrap gap-3">
                <a href="<?php echo e(route('editeur.articles.show', $article->id)); ?>" class="text-blue-600 hover:underline">Voir l’article</a>
                <form action="<?php echo e(route('editeur.articles.destroy', $article->id)); ?>" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="text-red-600 hover:underline">Supprimer</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


        
        <div class="hidden md:block overflow-x-auto mt-4">
    <table class="w-full bg-white shadow rounded text-sm">
        <thead>
            <tr class="bg-pink-100 text-pink-800">
                <th class="px-4 py-3 text-left">Titre</th>
                <th class="px-4 py-3 text-left">Créé le</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        
        <tbody>
            <?php $__currentLoopData = $articlesEnAttente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-t hover:bg-yellow-50">
                    <td class="px-4 py-2 font-semibold text-gray-800"><?php echo e($article->title); ?></td>
                    <td class="px-4 py-2 text-gray-600"><?php echo e($article->created_at->format('d/m/Y')); ?></td>
                    <td class="px-4 py-2">
                        <div class="flex flex-wrap gap-3">
                            <a href="<?php echo e(route('editeur.articles.show', $article->id)); ?>" class="text-blue-600 hover:underline">Voir</a>
                            <form action="<?php echo e(route('editeur.articles.destroy', $article->id)); ?>" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

    <?php endif; ?>

    <div class="mt-6">
        <a href="<?php echo e(route('editeur.dashboard')); ?>"
           class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/articles/enAttente.blade.php ENDPATH**/ ?>