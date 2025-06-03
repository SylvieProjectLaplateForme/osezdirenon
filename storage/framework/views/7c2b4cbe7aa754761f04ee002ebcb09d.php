

<?php $__env->startSection('title', 'Créer un article'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold mb-6">📝 Nouvel article</h1>

    
    <?php if($errors->any()): ?>
        <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>• <?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('editeur.articles.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>

        <div>
            <label for="title" class="block font-semibold">Titre</label>
            <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>" required
                class="w-full border border-gray-300 rounded p-2">
        </div>

        <div>
            <label for="content" class="block font-semibold">Contenu</label>
            <textarea name="content" id="content" rows="6" required class="w-full border border-gray-300 rounded p-2"><?php echo e(old('content')); ?></textarea>
        </div>

        <div>
            <label for="category_id" class="block font-semibold">Catégorie</label>
            <select name="category_id" id="category_id" required class="w-full border border-gray-300 rounded p-2">
                <option value="">-- Choisir une catégorie --</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div>
            <label for="image" class="block font-semibold">Image à la une (optionnelle)</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="w-full border border-gray-300 rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Enregistrer l'article
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/articleCreate.blade.php ENDPATH**/ ?>