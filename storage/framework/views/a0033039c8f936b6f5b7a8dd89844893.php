

<?php $__env->startSection('title', 'Liste des éditeurs'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">👥 Liste des éditeurs</h1>

    
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3 border-b text-left">Nom</th>
                    <th class="px-6 py-3 border-b text-left">Prénom</th>
                    <th class="px-6 py-3 border-b text-left">Email</th>
                    <th class="px-6 py-3 border-b text-left">Inscrit le</th>
                    <th class="px-6 py-3 border-b text-left">Statut</th>
                    <th class="px-6 py-3 border-b text-left">Articles</th>
                    <th class="px-6 py-3 border-b text-left">Publicités</th>
                    <th class="px-6 py-3 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $editeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $editeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="border-t px-6 py-4"><?php echo e($editeur->name); ?></td>
                        <td class="border-t px-6 py-4"><?php echo e($editeur->prenom); ?></td>
                        <td class="border-t px-6 py-4"><?php echo e($editeur->email); ?></td>
                        <td class="border-t px-6 py-4"><?php echo e($editeur->created_at->format('d/m/Y')); ?></td>
                        <td class="border-t px-6 py-4">
                            <?php if($editeur->is_active): ?>
                                <span class="text-green-600">Actif</span>
                            <?php else: ?>
                                <span class="text-red-600">Désactivé</span>
                            <?php endif; ?>
                        </td>
                        <td class="border-t px-6 py-4"><?php echo e($editeur->articles->count()); ?></td>
                        <td class="border-t px-6 py-4"><?php echo e($editeur->publicites->count()); ?></td>
                        <td class="border-t px-6 py-4 space-x-2">
                            <form action="<?php echo e(route('admin.profil.toggle', $editeur->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <button type="submit" class="text-yellow-600 hover:underline">
                                    <?php echo e($editeur->is_active ? 'Désactiver' : 'Activer'); ?>

                                </button>
                            </form>
                            <a href="<?php echo e(route('admin.profil.show', $editeur->id)); ?>" class="text-blue-600 hover:underline">Voir</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    
    <div class="md:hidden space-y-4">
        <?php $__currentLoopData = $editeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $editeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-pink shadow rounded-lg p-4">
                <h2 class="text-lg font-semibold text-yellow-700"><?php echo e($editeur->prenom); ?> <?php echo e($editeur->name); ?></h2>
                <p class="text-sm text-gray-600">📧 <?php echo e($editeur->email); ?></p>
                <p class="text-sm text-gray-600">🗓️ Inscrit le : <?php echo e($editeur->created_at->format('d/m/Y')); ?></p>
                <p class="text-sm">Statut :
                    <?php if($editeur->is_active): ?>
                        <span class="text-green-600 font-semibold">Actif</span>
                    <?php else: ?>
                        <span class="text-red-600 font-semibold">Désactivé</span>
                    <?php endif; ?>
                </p>
                <p class="text-sm text-gray-600">📝 Articles : <?php echo e($editeur->articles->count()); ?></p>
                <p class="text-sm text-gray-600">💬 Publicités : <?php echo e($editeur->publicites->count()); ?></p>

                <div class="mt-3 flex flex-wrap gap-3">
                    <form action="<?php echo e(route('admin.profil.toggle', $editeur->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <button type="submit" class="text-yellow-600 underline">
                            <?php echo e($editeur->is_active ? 'Désactiver' : 'Activer'); ?>

                        </button>
                    </form>
                    <a href="<?php echo e(route('admin.profil.show', $editeur->id)); ?>" class="text-blue-600 underline">Voir</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="mt-8">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/editeurs/index.blade.php ENDPATH**/ ?>