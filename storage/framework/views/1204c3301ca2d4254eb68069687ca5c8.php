

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">📝 Mes Articles</h1>

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($articles->isEmpty()): ?>
    <p class="text-gray-500">Aucun article publié.</p>
<?php else: ?>

    <!-- ✅ VERSION MOBILE : cartes -->
    <div class="space-y-4 md:hidden">
        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white shadow rounded p-4">
                <h2 class="font-bold text-lg text-gray-800 mb-1"><?php echo e($article->title); ?></h2>
                <p class="text-sm text-gray-600">Catégorie : <?php echo e($article->category->name); ?></p>
                <p class="text-sm text-gray-600">Créé le : <?php echo e($article->created_at->format('d/m/Y')); ?></p>
                <p class="text-sm mb-2">
                    Statut :
                    <?php if($article->is_approved): ?>
                        <span class="text-green-600 font-semibold">✅ Validé</span>
                    <?php else: ?>
                        <span class="text-yellow-600 font-semibold">🕓 En attente</span>
                    <?php endif; ?>
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="<?php echo e(route('editeur.articles.show', $article->id)); ?>" class="text-blue-600 hover:underline">Voir</a>
                    <?php if(! $article->is_approved): ?>
                        <a href="<?php echo e(route('editeur.articles.edit', $article->id)); ?>" class="text-indigo-600 hover:underline">Modifier</a>
                        <form action="<?php echo e(route('editeur.articles.destroy', $article->id)); ?>" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- ✅ VERSION DESKTOP : tableau -->
    <div class="hidden md:block overflow-x-auto bg-white shadow rounded-lg mt-4">
        <table class="w-full table-auto text-sm min-w-[600px]">
            <thead class="bg-pink-100 text-pink-800">
                <tr>
                    <th class="px-4 py-2 text-left">Titre</th>
                    <th class="px-4 py-2 text-left">Catégorie</th>
                    <th class="px-4 py-2 text-left">Créé le</th>
                    <th class="px-4 py-2 text-left">Statut</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t">
                        <td class="px-4 py-2 font-semibold text-gray-800">
                            <?php echo e($article->title); ?>

                        </td>
                        <td class="px-4 py-2 text-gray-600">
                            <?php echo e($article->category->name); ?>

                        </td>
                        <td class="px-4 py-2 text-gray-600">
                            <?php echo e($article->created_at->format('d/m/Y')); ?>

                        </td>
                        <td class="px-4 py-2">
                            <?php if($article->is_approved): ?>
                                <span class="text-green-600 font-semibold">✅ Validé</span>
                            <?php else: ?>
                                <span class="text-yellow-600 font-semibold">🕓 En attente</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex flex-wrap gap-2">
                                <a href="<?php echo e(route('editeur.articles.show', $article->id)); ?>" class="text-blue-600 hover:underline">Voir</a>
                                <?php if(! $article->is_approved): ?>
                                    <a href="<?php echo e(route('editeur.articles.edit', $article->id)); ?>" class="text-indigo-600 hover:underline">Modifier</a>
                                    <form action="<?php echo e(route('editeur.articles.destroy', $article->id)); ?>" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>


    <!-- ✅ Retour tableau de bord -->
    <div class="mt-6">
        <a href="<?php echo e(route('editeur.dashboard')); ?>" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/articles/mesArticles.blade.php ENDPATH**/ ?>