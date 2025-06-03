

<?php $__env->startSection('title', 'Toutes les publicités'); ?>

<?php $__env->startSection('content'); ?>


<?php if(session('success')): ?>
    <div class="mb-4 text-green-600 font-semibold">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="mb-4 text-red-600 font-semibold">
        ❌ <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">📢 Toutes les publicités</h1>

    <?php if($publicites->isEmpty()): ?>
        <p class="text-gray-500">Aucune publicité trouvée.</p>
    <?php else: ?>

        
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">Titre</th>
                        <th class="px-6 py-3 text-left">Auteur</th>
                        <th class="px-6 py-3 text-left">Lien</th>
                        <th class="px-6 py-3 text-left">Statut</th>
                        <th class="px-6 py-3 text-left">Créée le</th>
                        <th class="px-6 py-3 text-left">Début</th>
                        <th class="px-6 py-3 text-left">Valide jusqu’au</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b text-gray-700">
                            <td class="px-6 py-4"><?php echo e($pub->titre); ?></td>
                            <td class="px-6 py-4"><?php echo e($pub->user->name ?? '-'); ?></td>
                            <td class="px-6 py-4">
                                <a href="<?php echo e($pub->lien); ?>" class="text-blue-600 hover:underline" target="_blank">Voir</a>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($pub->is_approved): ?>
                                    <span class="text-green-600 font-semibold">Validée</span>
                                <?php else: ?>
                                    <span class="text-yellow-500 font-semibold">En attente</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4"><?php echo e($pub->created_at ? \Carbon\Carbon::parse($pub->created_at)->format('d/m/Y') : '-'); ?></td>
                            <td class="px-6 py-4"><?php echo e($pub->date_debut ? \Carbon\Carbon::parse($pub->date_debut)->format('d/m/Y') : '-'); ?></td>
                            <td class="px-6 py-4"><?php echo e($pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : 'Non définie'); ?></td>
                            <td class="px-6 py-4 flex gap-2 flex-wrap">
                                <?php if(!$pub->is_approved): ?>
                                    <form method="POST" action="<?php echo e(route('admin.publicites.valider', $pub->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button class="text-green-600 hover:underline">Valider</button>
                                    </form>
                                <?php endif; ?>
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
                    <h2 class="text-lg font-bold text-gray-800"><?php echo e($pub->titre); ?></h2>
                    <p class="text-sm text-gray-600">👤 Auteur : <?php echo e($pub->user->name ?? '-'); ?></p>
                    <p class="text-sm text-gray-600">
                        🔗 Lien : 
                        <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 underline">Voir</a>
                    </p>
                    <p class="text-sm">
                        Statut :
                        <?php if($pub->is_approved): ?>
                            <span class="text-green-600 font-semibold">Validée</span>
                        <?php else: ?>
                            <span class="text-yellow-500 font-semibold">En attente</span>
                        <?php endif; ?>
                    </p>
                    <p class="text-sm text-gray-600">🗓️ Créée le : <?php echo e($pub->created_at ? \Carbon\Carbon::parse($pub->created_at)->format('d/m/Y') : '-'); ?></p>
                    <p class="text-sm text-gray-600">🚀 Début : <?php echo e($pub->date_debut ? \Carbon\Carbon::parse($pub->date_debut)->format('d/m/Y') : '-'); ?></p>
                    <p class="text-sm text-gray-600">⏳ Valide jusqu’au : <?php echo e($pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : 'Non définie'); ?></p>

                    <div class="mt-3 flex flex-wrap gap-3">
                        <?php if(!$pub->is_approved): ?>
                            <form method="POST" action="<?php echo e(route('admin.publicites.valider', $pub->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <button class="text-green-600 underline">Valider</button>
                            </form>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('admin.publicites.destroy', $pub->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600 underline">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="mt-6">
            <?php echo e($publicites->links()); ?>

        </div>
    <?php endif; ?>

    <div class="mt-8">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/publicites/index.blade.php ENDPATH**/ ?>