

<?php $__env->startSection('title', 'Mon profil'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    
    <h1 class="text-2xl font-bold mb-6">👤 Modifier mon profil</h1>

    
    <?php if(session('success')): ?>
        <div class="mb-4 text-green-600 font-semibold">
            ✅ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <form method="POST" action="<?php echo e(route('admin.profil.update', $user->id)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="mb-4">
            <label for="name" class="block font-medium">Nom</label>
            <input type="text" name="name" id="name" value="<?php echo e(old('name', $user->name)); ?>" class="input-field">
        </div>

        
        <div class="mb-4">
            <label for="email" class="block font-medium">Email</label>
            <input type="email" name="email" id="email" value="<?php echo e(old('email', $user->email)); ?>" class="input-field">
        </div>

        
        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                💾 Enregistrer
            </button>
        </div>
    </form>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .input-field {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        background-color: #f9fafb;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/profil/index.blade.php ENDPATH**/ ?>