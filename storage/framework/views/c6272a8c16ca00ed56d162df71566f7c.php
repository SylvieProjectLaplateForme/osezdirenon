 

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Bonjour, <?php echo e(Auth::user()->name); ?></h1>
   
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Tous les articles</h2>
        <p class="text-2xl font-semibold"><?php echo e($total); ?></p>
        <a href="<?php echo e(route('admin.articles.index')); ?>" class="text-blue-500 hover:underline">Voir</a>
    </div>
<!-- Articles validés -->
<div class="bg-white rounded shadow p-4 text-center">
    <h2 class="text-lg font-semibold">Validés</h2>
    <p class="text-2xl font-semibold"><?php echo e($valides); ?></p>
    <a href="<?php echo e(route('admin.articles.valides')); ?>" class="text-blue-500 hover:underline">Voir</a>
</div>

   
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">En attente</h2>
        <p class="text-2xl font-semibold"><?php echo e($attente); ?></p>
        <a href="<?php echo e(route('admin.articles.attente', ['filter' => 'attente'])); ?>" class="text-blue-500 hover:underline">Voir</a>
    </div>
    
<!-- Carte toutes les publicités -->
<div class="bg-white shadow rounded p-4">
    <div class="text-center">
        <h3 class="text-lg font-semibold">Toutes les publicités</h3>
        <div class="text-3xl font-bold mt-2">
            <?php echo e($totalPublicites); ?>

        </div>
        <a href="<?php echo e(route('admin.publicites.index')); ?>" class="text-blue-500 hover:underline mt-2 block">Voir</a>
    </div>
</div>

<!-- Carte publicités en attente -->
<div class="bg-white shadow rounded p-4">
    <div class="text-center">
        <h3 class="text-lg font-semibold">Publicités en attente</h3>
        <div class="text-3xl font-bold mt-2">
            <?php echo e($publicitesEnAttente); ?>

        </div>
        <a href="<?php echo e(route('admin.publicites.attente')); ?>" class="text-blue-500 hover:underline mt-2 block">Voir</a>
    </div>
</div>
<!-- commentaires -->
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Commentaires en attente</h2>
        <p class="text-2xl font-semibold"><?php echo e($commentsEnAttente); ?></p>
        <a href="<?php echo e(route('admin.comments.pending')); ?>" class="text-blue-500 hover:underline">Voir</a>
    </div>
    

</div>


<div class="grid md:grid-cols-2 gap-6 mb-8 justify-center">

    <div class="bg-white rounded shadow p-4 flex flex-col items-center">

        <h2 class="text-xl font-semibold mb-2">Évolution des publications</h2>
        <div class="h-48">
            <canvas id="articlesChart" class="w-full h-full"></canvas>
        </div>
    </div>

    <div class="bg-white rounded shadow p-4 flex flex-col items-center">

        <h2 class="text-xl font-semibold mb-2">Répartition des articles</h2>
        <div class="h-48">
            <canvas id="statusChart" class="w-full h-full"></canvas>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const months = <?php echo json_encode($months); ?>;
    const articlesPerMonth = <?php echo json_encode($articlesPerMonth); ?>;

    // Graphique en ligne - articles par mois
    new Chart(document.getElementById('articlesChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Articles par mois',
                data: articlesPerMonth,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique circulaire - validés / en attente
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Validés', 'En attente'],
            datasets: [{
                data: [<?php echo e($valides); ?>, <?php echo e($attente); ?>],
                backgroundColor: ['#10B981', '#FBBF24'],
                borderColor: ['#059669', '#D97706'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Utilisateur\Desktop\blog\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>