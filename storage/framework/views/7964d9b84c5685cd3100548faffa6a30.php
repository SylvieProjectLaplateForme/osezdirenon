

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">📢 Publicités Payées</h1>

    <?php if($publicites->isEmpty()): ?>
        <p class="text-gray-600">Vous n'avez pas encore de publicités payées.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <th class="py-3 px-4">Titre</th>
                        <th class="py-3 px-4">Lien</th>
                        <th class="py-3 px-4">Date début</th>
                        <th class="py-3 px-4">Date fin</th>
                        <th class="py-3 px-4">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t border-gray-200 text-sm text-gray-700 hover:bg-gray-50">
                            <td class="py-2 px-4 font-medium"><?php echo e($pub->titre); ?></td>
                            <td class="py-2 px-4 text-blue-600 underline">
                                <a href="<?php echo e($pub->lien); ?>" target="_blank">Voir le lien</a>
                            </td>
                            <td class="py-2 px-4"><?php echo e($pub->date_debut ? $pub->date_debut->format('d/m/Y') : '-'); ?></td>
                            
                            <td>
                                <?php echo e($pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-'); ?>

                            </td>
                            <td class="py-2 px-4">
                                <span class="text-green-600 font-semibold">✔ Payée</span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="mt-6">
        <a href="<?php echo e(route('editeur.dashboard')); ?>" class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/publicitesPayees.blade.php ENDPATH**/ ?>