

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6 text-pink-600">✏️ Modifier l’article</h1>

    <form action="<?php echo e(route('admin.articles.update', $article->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Titre</label>
            <input type="text" name="title" id="title" value="<?php echo e(old('title', $article->title)); ?>"
                   class="w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label for="content" class="block font-semibold mb-1">Contenu</label>
            <textarea name="content" id="content" rows="8"
                      class="w-full border border-gray-300 rounded px-4 py-2"><?php echo e(old('content', $article->content)); ?></textarea>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block font-semibold mb-1">Catégorie</label>
            <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded px-4 py-2">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e($article->category_id == $cat->id ? 'selected' : ''); ?>>
                        <?php echo e($cat->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block font-semibold mb-1">Image (optionnelle)</label>
            <input type="file" name="image" id="image" class="w-full">
            <?php if($article->image): ?>
                <div class="mt-2">
                    <img src="<?php echo e(asset('storage/' . $article->image)); ?>" class="w-32 rounded shadow">
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                💾 Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/articles/edit.blade.php ENDPATH**/ ?>