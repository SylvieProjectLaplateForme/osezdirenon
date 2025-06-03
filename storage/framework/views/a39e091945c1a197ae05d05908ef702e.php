

<?php $__env->startSection('title', 'Détail de l’article'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-4"><?php echo e($article->title); ?></h1>

    <p class="text-sm text-gray-500 mb-4">
        Publié par <strong><?php echo e($article->user->name ?? 'Inconnu'); ?></strong>
        le <?php echo e($article->created_at->format('d/m/Y')); ?>

    </p>

    <?php if($article->image): ?>
        <img src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="Image de l'article" class="mb-6 rounded shadow w-full">
    <?php endif; ?>

    <div class="prose">
        <?php echo nl2br(e($article->content)); ?>

    </div>

    <div class="mt-6">
        <a href="<?php echo e(route('admin.articles.index')); ?>" class="inline-block text-blue-600 hover:underline">
            ← Retour à la liste des articles
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/articles/show.blade.php ENDPATH**/ ?>