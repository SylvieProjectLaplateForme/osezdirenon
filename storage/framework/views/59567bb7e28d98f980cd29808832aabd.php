<?php $__env->startSection('title', 'Commentaires à valider'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-3xl font-bold text-pink-600 mb-6">🕒 Commentaires en attente de validation</h1>

    
    <?php if(session('success')): ?>
        <div class="bg-green-200 text-green-800 p-3 rounded mb-6">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($commentaires->count()): ?>
        <table class="min-w-full bg-white border rounded shadow text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Auteur</th>
                    <th class="px-4 py-2 text-left">Commentaire</th>
                    <th class="px-4 py-2 text-left">Article</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $commentaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t">
                        <td class="px-4 py-2"><?php echo e($comment->user->name ?? 'Utilisateur inconnu'); ?></td>
                        <td class="px-4 py-2"><?php echo e($comment->content); ?></td>
                        <td class="px-4 py-2">
                            <a href="<?php echo e(route('article.show', $comment->article->slug)); ?>" class="text-blue-600 underline">
                                <?php echo e($comment->article->title); ?>

                            </a>
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            
                            <form method="POST" action="<?php echo e(route('admin.comments.validate', $comment->id)); ?>" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    ✅ Valider
                                </button>
                            </form>

                            
                            <form method="POST" action="<?php echo e(route('admin.comments.destroy', $comment->id)); ?>" class="inline" onsubmit="return confirm('Supprimer ce commentaire ?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-gray-600">Aucun commentaire en attente de validation.</p>
    <?php endif; ?>

    <div class="mt-8">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/commentPending.blade.php ENDPATH**/ ?>