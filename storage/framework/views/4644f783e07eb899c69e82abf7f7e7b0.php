<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto py-10 px-4">
    
    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6 shadow text-center">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="flex flex-col md:flex-row gap-8">
        
        <div class="md:w-2/3">
            
            <h1 class="text-3xl font-bold mb-2"><?php echo e($article->title); ?></h1>
            <p class="text-sm text-gray-500 mb-4">
                Par <strong><?php echo e($article->user->name ?? 'Anonyme'); ?></strong> - <?php echo e($article->created_at->format('d/m/Y')); ?>

            </p>

            
            <?php if($article->image): ?>
                <div class="mb-6">
                    <img src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="Image de l'article" class="w-full rounded-lg shadow">
                </div>
            <?php endif; ?>

            
            <div class="prose max-w-none bg-white p-6 rounded shadow mb-10">
                <?php $__currentLoopData = explode("\n", $article->content); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(trim($paragraph) !== ''): ?>
                        <p><?php echo e($paragraph); ?></p>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="bg-gray-50 p-6 rounded shadow mb-8">
                <h2 class="text-2xl font-semibold mb-4">💬 Commentaires</h2>

                <?php $__empty_1 = true; $__currentLoopData = $article->comments->where('is_approved', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white p-4 rounded shadow mb-3">
                        <p class="text-sm font-semibold text-gray-700"><?php echo e($comment->user->name ?? 'Utilisateur supprimé'); ?></p>
                        <p class="mt-1 whitespace-pre-line text-gray-800"><?php echo e($comment->content); ?></p>
                        <p class="text-xs text-gray-400 text-right">Posté le <?php echo e($comment->created_at->format('d/m/Y à H:i')); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500">Aucun commentaire validé pour le moment.</p>
                <?php endif; ?>
            </div>

            
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-xl font-bold mb-4">✍️ Laisser un commentaire</h3>

                <?php if(auth()->guard()->check()): ?>
                    <form method="POST" action="<?php echo e(route('comment.store', $article)); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea name="content" id="content" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required></textarea>
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Envoyer
                        </button>
                    </form>
                <?php else: ?>
                    <p class="text-gray-600">
                        Veuillez
                        <a href="<?php echo e(route('login', ['redirect' => request()->fullUrl()])); ?>"
                           class="text-pink-500 underline">vous connecter</a>
                        pour laisser un commentaire.
                    </p>
                <?php endif; ?>
            </div>
        </div>

        
        <aside class="md:w-1/3">
            <?php if($similaires->count()): ?>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-pink-600 mb-4">D'autres articles similaires</h2>

                    <?php $__currentLoopData = $similaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-4 border-b pb-4">
                            <?php if($similaire->image): ?>
                                <a href="<?php echo e(route('article.show', $similaire->slug)); ?>">
                                    <img src="<?php echo e(asset('storage/' . $similaire->image)); ?>"
                                         alt="<?php echo e($similaire->title); ?>"
                                         class="rounded w-full h-32 object-cover mb-2">
                                </a>
                            <?php endif; ?>

                            <p class="text-xs text-pink-500 font-medium mb-1">
                                <?php echo e($similaire->category->name ?? 'Non catégorisé'); ?> |
                                <?php echo e($similaire->created_at->format('d/m/Y')); ?>

                            </p>

                            <a href="<?php echo e(route('article.show', $similaire->slug)); ?>"
                               class="text-sm font-semibold text-gray-800 hover:text-pink-600 block">
                                <?php echo e($similaire->title); ?>

                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/article.blade.php ENDPATH**/ ?>