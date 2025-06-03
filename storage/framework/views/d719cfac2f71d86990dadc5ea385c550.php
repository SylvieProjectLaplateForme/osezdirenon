<?php $__env->startSection('title', 'Mes publicités en attente'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">⏳ Mes publicités en attente</h1>

    <?php if($publicites->count()): ?>

        
        <div class="space-y-4 md:hidden">
            <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-yellow-50 border border-yellow-200 shadow rounded p-4 text-sm">
                    <h2 class="text-lg font-semibold text-gray-800 mb-1"><?php echo e($pub->titre); ?></h2>
                    <p class="text-gray-600 mb-1">Soumise le <?php echo e($pub->created_at->format('d/m/Y')); ?></p>
                    <p>
                        Lien :
                        <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 underline">Voir</a>
                    </p>
                    <?php if($pub->is_approved && ! $pub->paid): ?>
                        <p class="text-orange-600 font-semibold mt-2">⚠️ À payer</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="hidden md:block overflow-x-auto mt-4">
            <table class="w-full bg-white shadow rounded text-sm">
                <thead>
                    <tr class="bg-yellow-100 text-yellow-900 uppercase text-xs">
                        <th class="px-4 py-3 text-left">Titre</th>
                        <th class="px-4 py-3 text-left">Soumise le</th>
                        <th class="px-4 py-3 text-left">Lien</th>
                        <th class="px-4 py-3 text-left">À payer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t hover:bg-yellow-50">
                            <td class="px-4 py-2 font-semibold text-gray-800"><?php echo e($pub->titre); ?></td>
                            <td class="px-4 py-2 text-gray-600"><?php echo e($pub->created_at->format('d/m/Y')); ?></td>
                            <td class="px-4 py-2">
                                <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 hover:underline">Voir le lien</a>
                            </td>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>
        <p class="text-gray-600">Aucune publicité en attente.</p>
    <?php endif; ?>

    <div class="mt-6">
        <a href="<?php echo e(route('editeur.dashboard')); ?>" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/publicites/enAttente.blade.php ENDPATH**/ ?>