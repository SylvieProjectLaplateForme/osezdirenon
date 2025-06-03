

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">📢 Toutes mes Publicités</h1>

    <?php if($publicites->isEmpty()): ?>
        <p class="text-gray-600">Aucune publicité.</p>
    <?php else: ?>
        
        <div class="space-y-4 md:hidden">
            <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow rounded p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-1"><?php echo e($pub->titre); ?></h2>
                    <p class="text-sm mb-1">
                        Lien : <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 underline">Voir</a>
                    </p>
                    <p class="text-sm text-gray-600">Créée le : <?php echo e($pub->created_at?->format('d/m/Y') ?? '-'); ?></p>
                    <p class="text-sm text-gray-600">Validée le : <?php echo e($pub->is_approved && $pub->updated_at ? $pub->updated_at->format('d/m/Y') : '-'); ?></p>
                    <p class="text-sm text-gray-600">Payée le :
                        <?php echo e($pub->paiement?->paid_at ? \Carbon\Carbon::parse($pub->paiement->paid_at)->format('d/m/Y') : '-'); ?>

                    </p>
                    <p class="text-sm text-gray-600">Valide jusqu’au : <?php echo e($pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-'); ?></p>
                    <p class="text-sm mt-2">
                        Statut :
                        <?php if($pub->paid): ?>
                            <span class="text-green-600 font-semibold">✔️ Payée</span>
                        <?php else: ?>
                            <span class="text-red-500 font-semibold">❌ Non payée</span>
                        <?php endif; ?>
                    </p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="hidden md:block overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-800 uppercase text-xs">
                        <th class="px-4 py-3 text-left">Titre</th>
                        <th class="px-4 py-3 text-left">Lien</th>
                        <th class="px-4 py-3 text-left">Créée le</th>
                        <th class="px-4 py-3 text-left">Validée le</th>
                        <th class="px-4 py-3 text-left">Payée le</th>
                        <th class="px-4 py-3 text-left">Valide jusqu’au</th>
                        <th class="px-4 py-3 text-left">Statut</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b text-gray-800">
                            <td class="px-4 py-2 font-semibold"><?php echo e($pub->titre); ?></td>
                            <td class="px-4 py-2">
                                <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 underline">Voir le lien</a>
                            </td>
                            <td class="px-4 py-2"><?php echo e($pub->created_at?->format('d/m/Y') ?? '-'); ?></td>
                            <td class="px-4 py-2"><?php echo e($pub->is_approved && $pub->updated_at ? $pub->updated_at->format('d/m/Y') : '-'); ?></td>
                            <td class="px-4 py-2"><?php echo e($pub->paiement?->paid_at ? \Carbon\Carbon::parse($pub->paiement->paid_at)->format('d/m/Y') : '-'); ?></td>
                            <td class="px-4 py-2"><?php echo e($pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-'); ?></td>
                            <td class="px-4 py-2">
                                <?php if($pub->paid): ?>
                                    <span class="text-green-600 font-semibold">✔️ Payée</span>
                                <?php else: ?>
                                    <span class="text-red-500 font-semibold">❌ Non payée</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2">
                                
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="mt-6">
        <a href="<?php echo e(route('editeur.dashboard')); ?>" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/publicites/index.blade.php ENDPATH**/ ?>