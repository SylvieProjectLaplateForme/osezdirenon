

<?php $__env->startSection('title', 'Publicités en attente'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">📢 Publicités en attente de validation</h1>

    <?php if($publicites->count()): ?>

        
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg">
                <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-2 border-b text-left">Titre</th>
                        <th class="px-4 py-2 border-b text-left">Lien</th>
                        <th class="px-4 py-2 border-b text-left">Auteur</th>
                        <th class="px-4 py-2 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?php echo e($pub->titre); ?></td>
                            <td class="px-4 py-2">
                                <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 underline">Voir</a>
                            </td>
                            <td class="px-4 py-2"><?php echo e($pub->user->name ?? '—'); ?></td>
                            <td class="px-4 py-2 flex gap-2">
                                <form method="POST" action="<?php echo e(route('admin.publicites.valider', $pub->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button class="text-green-600 hover:underline">Valider</button>
                                </form>
                                <form method="POST" action="<?php echo e(route('admin.publicites.destroy', $pub->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        
        <div class="md:hidden space-y-4">
            <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800"><?php echo e($pub->titre); ?></h2>
                    <p class="text-sm text-gray-600">🔗 
                        <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 underline">Voir le lien</a>
                    </p>
                    <p class="text-sm text-gray-600">👤 Auteur : <?php echo e($pub->user->name ?? '—'); ?></p>

                    <div class="mt-3 flex flex-wrap gap-3">
                        <form method="POST" action="<?php echo e(route('admin.publicites.valider', $pub->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <button class="text-green-600 underline">Valider</button>
                        </form>
                        <form method="POST" action="<?php echo e(route('admin.publicites.destroy', $pub->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600 underline">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    <?php else: ?>
        <p class="text-gray-600">Aucune publicité en attente pour le moment.</p>
    <?php endif; ?>

    <div class="mt-8">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/publicites/attente.blade.php ENDPATH**/ ?>