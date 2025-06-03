


<?php $__env->startSection('title', 'Soumettre une publicité'); ?>


<?php $__env->startSection('content'); ?>
    <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow mt-10">
        <h1 class="text-2xl font-bold mb-6">Soumettre une publicité</h1>


        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>


        <form action="<?php echo e(route('publicite.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>


            <div class="mb-4">
                <label for="titre" class="block font-semibold mb-1">Titre *</label>
                <input type="text" name="titre" id="titre" value="<?php echo e(old('titre')); ?>"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
                <?php $__errorArgs = ['titre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>


            <div class="mb-4">
                <label for="lien" class="block font-semibold mb-1">Lien *</label>
                <input type="url" name="lien" id="lien" value="<?php echo e(old('lien')); ?>"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
                <?php $__errorArgs = ['lien'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>


            <div class="mb-4">
                <label for="image" class="block font-semibold mb-1">Image</label>
                <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded px-4 py-2">
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>


            <?php
                use Carbon\Carbon;

                Carbon::setLocale('fr');

                $defaultDateDebut = old('date_debut', now()->format('Y-m-d'));
                $dateFin = Carbon::parse($defaultDateDebut)->addMonth();
                $defaultDateFin = $dateFin->translatedFormat('d F Y'); // ex : 11 juin 2025
            ?>


            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="date_debut" class="block font-semibold mb-1">Date de début</label>
                    <input type="date" name="date_debut" id="date_debut"
                        class="w-full border border-gray-300 rounded px-4 py-2" value="<?php echo e($defaultDateDebut); ?>">
                    <?php $__errorArgs = ['date_debut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>


                <div>
                    <label class="block font-semibold mb-1">Date de fin (automatique)</label>
                    <input type="text" class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100"
                        value="<?php echo e($defaultDateFin); ?>" readonly>
                </div>
            </div>



            
            
            <div class="pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                    🚀 Soumettre la publicité
                </button>

            </div>
    </div>


    </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/createPub.blade.php ENDPATH**/ ?>