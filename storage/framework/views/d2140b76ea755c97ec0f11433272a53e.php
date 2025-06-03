

<?php $__env->startSection('title', 'Statistiques des paiements'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">💶 Statistiques des publicités payées</h1>

    
    <form method="GET" class="mb-6 flex flex-col md:flex-row gap-4">
        <select name="mois" class="border p-2 rounded">
            <option value="">-- Mois --</option>
            <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($m); ?>" <?php echo e(request('mois') == $m ? 'selected' : ''); ?>>
                    <?php echo e(str_pad($m, 2, '0', STR_PAD_LEFT)); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="annee" class="border p-2 rounded">
            <option value="">-- Année --</option>
            <?php $__currentLoopData = range(date('Y'), date('Y') - 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($y); ?>" <?php echo e(request('annee') == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filtrer</button>
    </form>

    
    <p class="text-lg mb-4">💰 Total des paiements :
        <strong class="text-green-600"><?php echo e(number_format($total, 2, ',', ' ')); ?> €</strong>
    </p>

    
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full border">
            <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                <tr class="bg-pink-200">
                    <th class="px-4 py-2 text-left">Publicité</th>
                    <th class="px-4 py-2 text-left">Montant</th>
                    <th class="px-4 py-2 text-left">Payée le</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $paiements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paiement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t">
                        <td class="px-4 py-2"><?php echo e($paiement->publicite->titre ?? '-'); ?></td>
                        <td class="px-4 py-2"><?php echo e(number_format($paiement->amount, 2, ',', ' ')); ?> €</td>
                        <td class="px-4 py-2">
                            <?php echo e($paiement->paid_at ? \Carbon\Carbon::parse($paiement->paid_at)->format('d/m/Y') : '-'); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3" class="px-4 py-2 text-gray-500">Aucun paiement trouvé.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="md:hidden space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = $paiements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paiement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white-50 border rounded-lg p-4 shadow">
                <h2 class="font-semibold text-gray-800"><?php echo e($paiement->publicite->titre ?? '-'); ?></h2>
                <p class="text-sm text-gray-600">💰 Montant :
                    <span class="text-green-600"><?php echo e(number_format($paiement->amount, 2, ',', ' ')); ?> €</span>
                </p>
                <p class="text-sm text-gray-600">📅 Payée le :
                    <?php echo e($paiement->paid_at ? \Carbon\Carbon::parse($paiement->paid_at)->format('d/m/Y') : '-'); ?>

                </p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500">Aucun paiement trouvé.</p>
        <?php endif; ?>
    </div>
    <div class="mt-8">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/stats/paiements.blade.php ENDPATH**/ ?>