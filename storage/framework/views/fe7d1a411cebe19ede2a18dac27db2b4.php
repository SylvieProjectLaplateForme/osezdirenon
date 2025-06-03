

<?php $__env->startSection('title', 'Publicités à payer'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">💳 Publicités en attente de paiement</h1>

    <?php if($publicites->count()): ?>

        
        <div class="space-y-4 md:hidden">
            <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-pink-100 text-pink-800 uppercase text-x">
                    <h2 class="text-lg font-semibold text-gray-800 mb-1"><?php echo e($pub->titre); ?></h2>
                    <p class="text-gray-600">Validée le <?php echo e($pub->updated_at->format('d/m/Y')); ?></p>
                    <p class="text-blue-600 underline mb-2">
                        <a href="<?php echo e($pub->lien); ?>" target="_blank">Voir la publicité</a>
                    </p>
                    <form action="<?php echo e(route('stripe.checkout', $pub->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                            💳 Payer maintenant
                        </button>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="hidden md:block overflow-x-auto mt-6">
            <table class="w-full bg-white shadow rounded text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-800 uppercase text-xs">
                        <th class="px-4 py-3 text-left">Titre</th>
                        <th class="px-4 py-3 text-left">Validée le</th>
                        <th class="px-4 py-3 text-left">Lien</th>
                        <th class="px-4 py-3 text-left">Paiement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t hover:bg-blue-50">
                            <td class="px-4 py-2 font-semibold text-gray-800"><?php echo e($pub->titre); ?></td>
                            <td class="px-4 py-2 text-gray-600"><?php echo e($pub->updated_at->format('d/m/Y')); ?></td>
                            <td class="px-4 py-2">
                                <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 hover:underline">Voir</a>
                            </td>
                            <td class="px-4 py-2">
                                <form action="<?php echo e(route('stripe.checkout', $pub->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">
                                        💳 Payer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>
        <p class="text-gray-600">Aucune publicité en attente de paiement.</p>
    <?php endif; ?>

    <div class="mt-6">
        <a href="<?php echo e(route('editeur.dashboard')); ?>" class="inline-block text-blue-600 hover:underline">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/publicites/aPayer.blade.php ENDPATH**/ ?>