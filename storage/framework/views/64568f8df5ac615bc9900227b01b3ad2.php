<?php $__env->startSection('title', 'Mon profil'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">👤 Modifier mon profil</h1>

    
    <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
        <?php echo csrf_field(); ?>
    </form>

    
    <form method="post" action="<?php echo e(route('editeur.profile.update')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('patch'); ?>

        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input id="name" name="name" type="text" value="<?php echo e(old('name', $user->name)); ?>" required
                class="w-full mt-1 p-2 border border-gray-300 rounded">
            <?php $__errorArgs = ['name'];
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
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="<?php echo e(old('email', $user->email)); ?>" required
                class="w-full mt-1 p-2 border border-gray-300 rounded">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                <div class="mt-2 text-sm text-gray-800">
                    Votre adresse email n'est pas validée.

                    <button form="send-verification"
                        class="underline text-sm text-blue-600 hover:text-blue-800 transition">
                        Cliquez ici pour renvoyer l'e-mail de vérification.
                    </button>

                    <?php if(session('status') === 'verification-link-sent'): ?>
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="flex justify-between items-center">
            <a href="<?php echo e(route('editeur.dashboard')); ?>" class="text-blue-600 hover:underline">← Retour au dashboard</a>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                💾 Sauvegarder
            </button>
        </div>

        <?php if(session('status') === 'profile-updated'): ?>
            <p class="text-sm text-green-600 mt-2">
                ✅ Profil mis à jour avec succès.
            </p>
        <?php endif; ?>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('editeur.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/profile/edit.blade.php ENDPATH**/ ?>