

<?php $__env->startSection('title', 'Commentaires'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-3xl font-bold mb-6">🛠️ Liste de tous les commentaires</h1>


<h2 class="text-xl font-semibold text-yellow-600 mb-4">🕒 Commentaires en attente</h2>

<?php if($enAttente->isEmpty()): ?>
    <p class="mb-8">Aucun commentaire en attente.</p>
<?php else: ?>
    <div class="overflow-x-auto mb-10">
        <table class="min-w-full bg-white border border-yellow-300 rounded shadow text-sm">
            <thead class="bg-yellow-100 text-left">
                <tr>
                    <th class="px-4 py-2 border-b">Article</th>
                    <th class="px-4 py-2 border-b">Auteur</th>
                    <th class="px-4 py-2 border-b">Contenu</th>
                    <th class="px-4 py-2 border-b">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $enAttente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-yellow-50">
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->article->title ?? '⚠️ Article supprimé'); ?></td>
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->user->name ?? 'Anonyme'); ?></td>
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->content); ?></td>
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->created_at->format('d/m/Y à H:i')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>


<h2 class="text-xl font-semibold text-green-600 mb-4">✅ Commentaires validés (articles existants)</h2>

<?php
    $validesActifs = $valides->filter(fn($c) => $c->article !== null);
?>

<?php if($validesActifs->isEmpty()): ?>
    <p class="mb-8">Aucun commentaire validé avec article existant.</p>
<?php else: ?>
    <div class="overflow-x-auto mb-10">
        <table class="min-w-full bg-white border border-green-300 rounded shadow text-sm">
            <thead class="bg-pink-100 text-left">
                <tr>
                    <th class="px-4 py-2 border-b">Article</th>
                    <th class="px-4 py-2 border-b">Auteur</th>
                    <th class="px-4 py-2 border-b">Contenu</th>
                    <th class="px-4 py-2 border-b">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $validesActifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-green-50">
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->article->title); ?></td>
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->user->name ?? 'Anonyme'); ?></td>
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->content); ?></td>
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->created_at->format('d/m/Y à H:i')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>


<h2 class="text-xl font-semibold text-red-600 mb-4">🚫 Commentaires validés (article supprimé)</h2>

<?php
    $validesOrphelins = $valides->filter(fn($c) => $c->article === null);
?>

<?php if($validesOrphelins->isEmpty()): ?>
    <p>Aucun commentaire lié à un article supprimé.</p>
<?php else: ?>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-red-300 rounded shadow text-sm">
            <thead class="bg-red-100 text-left">
                <tr>
                    <th class="px-4 py-2 border-b">Auteur</th>
                    <th class="px-4 py-2 border-b">Contenu</th>
                    <th class="px-4 py-2 border-b">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $validesOrphelins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-red-50">
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->user->name ?? 'Anonyme'); ?></td>
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->content); ?></td>
                        <td class="px-4 py-2 border-b"><?php echo e($commentaire->created_at->format('d/m/Y à H:i')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<a href="<?php echo e(route('admin.dashboard')); ?>" class="inline-block mt-8 text-blue-600 hover:underline">← Retour au dashboard</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/commentairesIndex.blade.php ENDPATH**/ ?>