

<?php $__env->startSection('title', 'Mes articles'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">📄 Mes articles</h1>

    <?php if($articles->isEmpty()): ?>
        <p>Aucun article pour l’instant.</p>
    <?php else: ?>
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-2 px-4">Titre</th>
                    <th class="py-2 px-4">Catégorie</th>
                    <th class="py-2 px-4">Date</th>
                    <th class="py-2 px-4">Statut</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4"><?php echo e($article->title); ?></td>
                    <td class="py-2 px-4"><?php echo e($article->category->name ?? 'Non défini'); ?></td>
                    <td class="py-2 px-4"><?php echo e($article->created_at->format('d/m/Y')); ?></td>
                    <td class="py-2 px-4">
                        <?php if($article->is_approved): ?>
                            <span class="text-green-600">✔ Validé</span>
                        <?php else: ?>
                            <span class="text-yellow-600">⏳ En attente</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-2 px-4">
                        <a href="<?php echo e(route('article.show', $article->slug)); ?>" class="text-blue-600 hover:underline">Voir</a>
                        
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="mt-6">
            <?php echo e($articles->links()); ?>

        </div>
    <?php endif; ?>
    <div class="mt-6">
        <a href="<?php echo e(route('editeur.dashboard')); ?>" class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/editeur/articles/index.blade.php ENDPATH**/ ?>