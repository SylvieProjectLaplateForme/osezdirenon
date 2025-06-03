


<?php $__env->startSection('title', $article->title); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

    
    <div class="lg:col-span-2">
        <h1 class="text-3xl font-bold mb-4"><?php echo e($article->title); ?></h1>

        
        <p class="text-sm text-gray-600 mb-2">
            Par <strong><?php echo e($article->user->name ?? 'Auteur inconnu'); ?></strong>
            le <?php echo e($article->created_at->format('d/m/Y')); ?>

        </p>

        
        <?php if($article->image): ?>
        <div class="mb-6">
            <img 
                src="<?php echo e(asset('storage/' . $article->image)); ?>" 
                alt="Image de l'article"
                class="mx-auto block max-w-full rounded-lg shadow-md"
            >
        </div>
        <?php endif; ?>

        
        <div class="prose max-w-none text-gray-800">
            <?php echo nl2br(e($article->content)); ?>

        </div>
        <?php if(!$article->is_approved): ?>
    <div class="mt-6">
        <a href="<?php echo e(route('editeur.articles.edit', $article->id)); ?>"
           class="inline-block bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-600">
            ✏️ Modifier l'article
        </a>
    </div>
<?php endif; ?>

        
        <h2 class="text-xl font-semibold mt-10 mb-4">Commentaires</h2>

        <?php $__empty_1 = true; $__currentLoopData = $article->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if($comment->is_approved): ?>
                <div class="border-t pt-4 mt-4">
                    <p class="text-sm text-gray-700">
                        <strong><?php echo e($comment->author); ?></strong>
                        le <?php echo e($comment->created_at->format('d/m/Y à H:i')); ?>

                    </p>
                    <p class="mt-1"><?php echo e($comment->content); ?></p>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Aucun commentaire pour le moment.</p>
        <?php endif; ?>

        
        <h3 class="text-lg font-semibold mt-10 mb-4">Laisser un commentaire</h3>

        <form method="POST" action="<?php echo e(route('comment.store')); ?>" class="bg-white p-4 rounded shadow">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="article_id" value="<?php echo e($article->id); ?>">

            <div class="mb-4">
                <label for="author" class="block text-sm font-medium text-gray-700">Votre nom</label>
                <input type="text" name="author" id="author" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Votre commentaire</label>
                <textarea name="content" id="content" rows="4" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2"></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer</button>
        </form>
    </div>

    
    <aside class="space-y-6">
        <h3 class="text-xl font-semibold text-pink-600 mb-4">D'autres articles similaires</h3>

        <?php $__currentLoopData = $similaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border-b pb-4">
                <a href="<?php echo e(route('article.show', $similaire->slug)); ?>">
                    <img src="<?php echo e(asset('storage/' . ($similaire->image ?? 'articles/default.jpg'))); ?>" class="rounded mb-2">
                    <p class="text-sm text-pink-600"><?php echo e($similaire->category->name); ?> | <?php echo e($similaire->created_at->format('d/m/Y')); ?></p>
                    <h4 class="font-bold hover:text-pink-500"><?php echo e($similaire->title); ?></h4>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </aside>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/articles/show.blade.php ENDPATH**/ ?>