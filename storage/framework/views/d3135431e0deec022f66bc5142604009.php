

<?php $__env->startSection('title', 'Mes paiements'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">💳 Mes paiements</h1>

    <?php if($paiements->isEmpty()): ?>
        <p class="text-gray-600">Aucun paiement trouvé.</p>
    <?php else: ?>

        
        <div class="space-y-4 md:hidden">
            <?php $__currentLoopData = $paiements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paiement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow rounded p-4 text-sm">
                    <h2 class="font-semibold text-gray-800 mb-2">
                        Publicité :
                        <?php if($paiement->publicite): ?>
                            <a href="<?php echo e(route('editeur.publicites.index')); ?>" class="text-blue-600 underline">
                                <?php echo e($paiement->publicite->titre); ?>

                            </a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </h2>

                    <p>💶 Montant : <?php echo e(number_format($paiement->amount, 2, ',', ' ')); ?> €</p>
                    <p>Méthode : <?php echo e(ucfirst($paiement->payment_method ?? 'N/A')); ?></p>
                    <p>Carte : **** <?php echo e($paiement->payment_last4 ?? '----'); ?></p>
                    <p>Payé le : <?php echo e($paiement->paid_at ? $paiement->paid_at->format('d/m/Y') : 'Non payé'); ?></p>
                    <p>
                        Statut :
                        <?php if($paiement->status === 'payé'): ?>
                            <span class="text-green-600 font-semibold">✅ Payé</span>
                        <?php else: ?>
                            <span class="text-red-600 font-semibold">❌ En attente</span>
                        <?php endif; ?>
                    </p>
                    <p>
                        Reçu :
                        <?php if($paiement->stripe_payment_id): ?>
                            <a href="https://dashboard.stripe.com/payments/<?php echo e($paiement->stripe_payment_id); ?>"
                               target="_blank" class="text-blue-600 underline">Voir reçu</a>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="hidden md:block overflow-x-auto mt-4">
            <table class="w-full bg-white shadow rounded text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-800 uppercase text-xs">
                        <th class="px-4 py-2 text-left">Publicité</th>
                        <th class="px-4 py-2 text-left">Montant</th>
                        <th class="px-4 py-2 text-left">Méthode</th>
                        <th class="px-4 py-2 text-left">4 derniers chiffres</th>
                        <th class="px-4 py-2 text-left">Payé le</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $paiements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paiement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">
                                <?php if($paiement->publicite): ?>
                                    <a href="<?php echo e(route('editeur.publicites.index')); ?>" class="text-blue-600 hover:underline">
                                        <?php echo e($paiement->publicite->titre); ?>

                                    </a>
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2"><?php echo e(number_format($paiement->amount, 2, ',', ' ')); ?> €</td>
                            <td class="px-4 py-2"><?php echo e(ucfirst($paiement->payment_method ?? 'N/A')); ?></td>
                            <td class="px-4 py-2"><?php echo e($paiement->payment_last4 ?? '----'); ?></td>
                            <td class="px-4 py-2"><?php echo e($paiement->paid_at ? $paiement->paid_at->format('d/m/Y') : 'Non payé'); ?></td>
                            
                                
                            
                            
                             
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="text-right text-base font-semibold text-gray-700">
    💶 Total payé : <span class="text-green-600"><?php echo e(number_format($totalPaiements, 2, ',', ' ')); ?> €</span>
</div>
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

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/paiements/index.blade.php ENDPATH**/ ?>