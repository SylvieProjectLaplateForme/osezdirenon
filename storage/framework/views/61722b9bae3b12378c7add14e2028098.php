

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6">Nos publicités en ligne</h1>

    <?php if($publicites->count()): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php $__currentLoopData = $publicites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white p-4 shadow rounded">
                    <h2 class="text-xl font-semibold mb-2"><?php echo e($pub->titre); ?></h2>

                    <?php if($pub->image): ?>
                        <img src="<?php echo e(asset('storage/' . $pub->image)); ?>" alt="<?php echo e($pub->titre); ?>" class="w-full h-48 object-cover rounded mb-3">
                    <?php endif; ?>

                    <a href="<?php echo e($pub->lien); ?>" target="_blank" class="text-blue-600 underline">Visiter le site</a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p class="text-gray-600">Aucune publicité active pour le moment.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/publicites/publiques.blade.php ENDPATH**/ ?>