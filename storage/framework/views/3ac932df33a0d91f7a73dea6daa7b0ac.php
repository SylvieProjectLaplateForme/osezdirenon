

<?php $__env->startSection('title', 'Voir Profil'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">👤 Détails du profil</h1>

    <p><strong>Nom :</strong> <?php echo e($user->name); ?></p>
    <p><strong>Email :</strong> <?php echo e($user->email); ?></p>
    <p><strong>Statut :</strong> 
        <?php if($user->is_active): ?>
            <span class="text-green-600">Actif</span>
        <?php else: ?>
            <span class="text-red-600">Inactif</span>
        <?php endif; ?>
    </p>

    <div class="mt-6 flex gap-4">
        <form action="<?php echo e(route('admin.profil.toggle', $user->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                🔁 Changer le statut
            </button>
        </form>

        <a href="<?php echo e(route('admin.profil.index')); ?>" class="text-blue-600 hover:underline">← Retour</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/profil/show.blade.php ENDPATH**/ ?>