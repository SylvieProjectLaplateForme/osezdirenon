<?php $__env->startSection('title', 'Articles en attente'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">📄 Articles en attente de validation</h1>

    <?php if($articles->isEmpty()): ?>
        <p class="text-gray-600">Aucun article en attente.</p>
    <?php else: ?>
        
        <div class="hidden md:block overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full table-auto text-sm">
                <thead class="bg-pink-100 text-yellow-900 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Titre</th>
                        <th class="px-4 py-3 text-left">Auteur</th>
                        <th class="px-4 py-3 text-left">Créé le</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t hover:bg-pink-50">
                            <td class="px-4 py-2 font-semibold text-gray-800"><?php echo e($article->title); ?></td>
                            <td class="px-4 py-2 text-gray-700"><?php echo e($article->user->name); ?></td>
                            <td class="px-4 py-2 text-gray-500"><?php echo e($article->created_at->format('d/m/Y')); ?></td>
                            <td class="px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="<?php echo e(route('admin.articles.show', $article->id)); ?>" class="text-blue-600 hover:underline">Voir</a>
                                    <form action="<?php echo e(route('admin.articles.validate', $article->id)); ?>" method="POST" onsubmit="return confirm('Valider cet article ?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit" class="text-green-600 hover:underline">Valider</button>
                                    </form>
                                    <form action="<?php echo e(route('admin.articles.destroy', $article->id)); ?>" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        
        <div class="md:hidden space-y-4">
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800"><?php echo e($article->title); ?></h2>
                    <p class="text-sm text-gray-600">Par <?php echo e($article->user->name); ?> — <?php echo e($article->created_at->format('d/m/Y')); ?></p>

                    <div class="mt-3 flex flex-wrap gap-3">
                        <a href="<?php echo e(route('admin.articles.show', $article->id)); ?>" class="text-blue-600 underline">Voir</a>
                        <form action="<?php echo e(route('admin.articles.validate', $article->id)); ?>" method="POST" onsubmit="return confirm('Valider cet article ?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <button type="submit" class="text-green-600 underline">Valider</button>
                        </form>
                        <form action="<?php echo e(route('admin.articles.destroy', $article->id)); ?>" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 underline">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="mt-8">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/pendingArticle.blade.php ENDPATH**/ ?>