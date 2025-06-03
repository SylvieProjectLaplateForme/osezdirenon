

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">✏️ Modifier l'article</h1>

    <form method="POST" action="<?php echo e(route('editeur.articles.update', $article->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-4">
            <label>Titre</label>
            <input type="text" name="title" value="<?php echo e(old('title', $article->title)); ?>" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Catégorie</label>
            <select name="category_id" class="w-full border p-2 rounded">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e($cat->id == $article->category_id ? 'selected' : ''); ?>>
                        <?php echo e($cat->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-4">
            <label>Contenu</label>
            <textarea name="content" class="w-full border p-2 rounded" rows="8"><?php echo e(old('content', $article->content)); ?></textarea>
        </div>

        <div class="mb-4">
            <label>Image (optionnelle)</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">💾 Enregistrer</button>
    </form>
    
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/articles/edit.blade.php ENDPATH**/ ?>