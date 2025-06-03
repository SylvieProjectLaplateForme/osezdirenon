<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">📢 Publicités Payées</h1>

    <?php if($publicites->isEmpty()): ?>
        <p class="text-gray-600">Vous n'avez pas encore de publicités payées.</p>
    <?php else: ?>

        
        <div class="space-y-4 md:hidden">
            <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow rounded p-4 text-sm">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2"><?php echo e($pub->titre); ?></h2>

                    <p class="mb-1">Lien : 
                        <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 underline">Voir</a>
                    </p>

                    <p class="text-gray-700">💶 Montant : 
                        <strong><?php echo e($pub->paiement ? number_format($pub->paiement->amount, 2, ',', ' ') . ' €' : '-'); ?></strong>
                    </p>

                    <p class="text-gray-600">Payée le : 
                        <?php echo e(optional($pub->paiement?->paid_at)->format('d/m/Y') ?? '-'); ?>

                    </p>

                    <p class="text-gray-600">Date début : 
                        <?php echo e($pub->date_debut ? $pub->date_debut->format('d/m/Y') : '-'); ?>

                    </p>

                    <p class="text-gray-600">Date fin : 
                        <?php echo e($pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-'); ?>

                    </p>

                    <p class="mt-2 text-green-600 font-semibold">✔️ Publicité payée</p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="text-right text-lg font-semibold text-gray-700">
                💶 Total payé : <span class="text-green-600"><?php echo e(number_format($totalMontant, 2, ',', ' ')); ?> €</span>
            </div>
        </div>

        
        <div class="hidden md:block overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-800 uppercase text-xs">
                        <th class="py-3 px-4 text-left">Titre</th>
                        <th class="py-3 px-4 text-left">Lien</th>
                        <th class="py-3 px-4 text-left">Payée le</th>
                        <th class="py-3 px-4 text-left">Montant (€)</th>
                        <th class="py-3 px-4 text-left">Date début</th>
                        <th class="py-3 px-4 text-left">Date fin</th>
                        <th class="py-3 px-4 text-left">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="py-2 px-4 font-medium"><?php echo e($pub->titre); ?></td>
                            <td class="py-2 px-4">
                                <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 underline">Voir le lien</a>
                            </td>
                            <td class="px-4 py-2">
                                <?php echo e(optional($pub->paiement?->paid_at)->format('d/m/Y') ?? '-'); ?>

                            </td>
                            <td class="px-4 py-2">
                                <?php echo e($pub->paiement ? number_format($pub->paiement->amount, 2, ',', ' ') : '-'); ?>

                            </td>
                            <td class="py-2 px-4">
                                <?php echo e($pub->date_debut ? $pub->date_debut->format('d/m/Y') : '-'); ?>

                            </td>
                            <td class="py-2 px-4">
                                <?php echo e($pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : '-'); ?>

                            </td>
                            <td class="py-2 px-4">
                                <span class="text-green-600 font-semibold">✔ Payée</span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="text-right mt-4 text-lg font-semibold text-gray-700">
                💶 Total payé : <span class="text-green-600"><?php echo e(number_format($totalMontant, 2, ',', ' ')); ?> €</span>
            </div>
        </div>
    <?php endif; ?>

    <div class="mt-6">
        <a href="<?php echo e(route('editeur.dashboard')); ?>" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/publicites/payees.blade.php ENDPATH**/ ?>