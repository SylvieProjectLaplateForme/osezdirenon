

<?php $__env->startSection('title', 'Liste des articles'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<h1 class="text-3xl font-bold text-pink-600 mb-6">
    <?php if(request()->routeIs('admin.articles.valides')): ?>
         📄 Articles validés
    <?php else: ?>
        📄 Liste de tous les articles
    <?php endif; ?>
</h1>



    <?php if($articles->isEmpty()): ?>
        <p class="text-gray-500">Aucun article trouvé.</p>
    <?php else: ?>

        
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                    <tr class="bg-pink-200 text-yellow-700 text-sm uppercase">
                        <th class="px-6 py-3 text-left">Titre</th>
                        <th class="px-6 py-3 text-left">Auteur</th>
                        <th class="px-6 py-3 text-left">Catégorie</th>
                        <th class="px-6 py-3 text-left">Statut</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b text-gray-700">
                            <td class="px-6 py-4"><?php echo e($article->title); ?></td>
                            <td class="px-6 py-4"><?php echo e($article->user->name); ?></td>
                            <td class="px-6 py-4"><?php echo e($article->category->name ?? '-'); ?></td>
                            <td class="px-6 py-4">
                                <?php if($article->is_approved): ?>
                                    <span class="text-green-600 font-semibold">Validé</span>
                                <?php else: ?>
                                    <span class="text-yellow-500 font-semibold">En attente</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <?php if(!$article->is_approved): ?>
                                    <form method="POST" action="<?php echo e(route('admin.articles.validate', $article->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit" class="text-green-600 hover:underline">Valider</button>
                                    </form>
                                <?php endif; ?>

                                <form method="POST" action="<?php echo e(route('admin.articles.destroy', $article->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>

                                <a href="<?php echo e(route('admin.articles.show', $article->id)); ?>"
                                    class="text-blue-600 hover:underline">Voir</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        
        <div class="md:hidden space-y-4">
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800"><?php echo e($article->title); ?></h2>
                    <p class="text-sm text-gray-600">Auteur : <strong><?php echo e($article->user->name); ?></strong></p>
                    <p class="text-sm text-gray-600">Catégorie : <?php echo e($article->category->name ?? '-'); ?></p>
                    <p class="text-sm">
                        Statut :
                        <?php if($article->is_approved): ?>
                            <span class="text-green-600 font-semibold">Validé</span>
                        <?php else: ?>
                            <span class="text-yellow-500 font-semibold">En attente</span>
                        <?php endif; ?>
                    </p>

                    <div class="mt-3 flex flex-wrap gap-3">
                        <?php if(!$article->is_approved): ?>
                            <form method="POST" action="<?php echo e(route('admin.articles.validate', $article->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <button type="submit" class="text-green-600 underline">Valider</button>
                            </form>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('admin.articles.destroy', $article->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 underline">Supprimer</button>
                        </form>

                        <a href="<?php echo e(route('admin.articles.show', $article->id)); ?>"
                            class="text-blue-600 underline">Voir</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="mt-6">
            <?php echo e($articles->links()); ?>

        </div>
    <?php endif; ?>

    <div class="mt-8">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/articles/index.blade.php ENDPATH**/ ?>