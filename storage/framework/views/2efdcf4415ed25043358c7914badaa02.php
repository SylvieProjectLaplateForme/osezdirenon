

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="bg-green-200 text-green-800 px-4 py-3 rounded mb-6 text-center">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">📝 Mes articles</h1>

    <?php if($articles->count()): ?>

        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">Titre</th>
                        <th class="px-4 py-3 text-left">Catégorie</th>
                        <th class="px-4 py-3 text-left">Créé le</th>
                        <th class="px-4 py-3 text-left">Statut</th>
                        <th class="px-4 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b">
                            <td class="px-4 py-3 font-semibold"><?php echo e($article->title); ?></td>
                            <td class="px-4 py-3"><?php echo e($article->category->name ?? 'Non classé'); ?></td>
                            <td class="px-4 py-3"><?php echo e($article->created_at->format('d/m/Y')); ?></td>
                            <td class="px-4 py-3">
                                <?php if($article->is_approved): ?>
                                    <span class="text-green-600 font-semibold">✅ Validé</span>
                                <?php else: ?>
                                    <span class="text-yellow-600 font-semibold">⏳ En attente</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <a href="<?php echo e(route('admin.articles.edit', $article->id)); ?>"
                                   class="text-blue-600 hover:underline font-medium text-sm">✏️ Modifier</a>
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
                    <p class="text-sm text-gray-600">Catégorie :
                        <strong><?php echo e($article->category->name ?? 'Non classé'); ?></strong>
                    </p>
                    <p class="text-sm text-gray-600">Créé le :
                        <?php echo e($article->created_at->format('d/m/Y')); ?>

                    </p>
                    <p class="text-sm mt-1">
                        Statut :
                        <?php if($article->is_approved): ?>
                            <span class="text-green-600 font-semibold">✅ Validé</span>
                        <?php else: ?>
                            <span class="text-yellow-600 font-semibold">⏳ En attente</span>
                        <?php endif; ?>
                    </p>

                    <div class="mt-3">
                        <a href="<?php echo e(route('admin.articles.edit', $article->id)); ?>"
                           class="inline-block text-blue-600 underline text-sm font-medium">✏️ Modifier</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="mt-6">
            <?php echo e($articles->links()); ?>

        </div>

    <?php else: ?>
        <p class="text-gray-600">Vous n’avez rédigé aucun article pour le moment.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/articles/mes-articles.blade.php ENDPATH**/ ?>